<?php

namespace App\Services\Saas;

use App\Helpers\SaasHelper;
use App\Models\Package;
use App\Models\Saas\SubscriptionUser;
use App\Repositories\Saas\SubscriptionHistoryRepository;
use App\Repositories\Saas\SubscriptionMasterRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Saas\SubscriptionUserRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SubscriptionUserService
{
    private $subscriptionMasterRepository;
    private $subscriptionUserRepository;
    private $subscriptionHistoryRepository;
    private $userRepository;

    /**
     * =============================================
     *  constructor
     * =============================================
     */
    public function __construct(
        SubscriptionUserRepository $subscriptionUserRepository,
        SubscriptionHistoryRepository $subscriptionHistoryRepository,
        SubscriptionMasterRepository $subscriptionMasterRepository,
        UserRepository $userRepository
    ) {
        $this->subscriptionUserRepository = $subscriptionUserRepository;
        $this->subscriptionHistoryRepository = $subscriptionHistoryRepository;
        $this->subscriptionMasterRepository = $subscriptionMasterRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * =============================================
     *  list all susbcription along with filter, sort, etc
     * =============================================
     */
    public function listAllSubscription($perPage, string $sortField = null, string $sortOrder = null, string $keyword = null, string $userId = null): LengthAwarePaginator
    {
        $perPage = !is_null($perPage) ? $perPage : config('constant.CRUD.PER_PAGE');

        return $this->subscriptionUserRepository->getAllSubscription($perPage, $sortField, $sortOrder, $keyword, $userId);
    }

    /**
     * =============================================
     * get single subscription data
     * =============================================
     */
    public function getSubscriptionDetail($subscriptionUserId): ?SubscriptionUser
    {
        return $this->subscriptionUserRepository->getSubscriptionById($subscriptionUserId);
    }

    /**
     * =============================================
     * suspend / unsuspend subscription
     * 1 : suspend (default)
     * 2 : unsuspend
     * =============================================
     */
    public function suspendUnsuspend($subscriptionId, $action = 1, $initiator = "system"): ?SubscriptionUser
    {
        DB::beginTransaction();
        try {
            $isSuspended = $action == 1 ? true : false;
            $historyAction = $action == 1 ? "SUSPEND" : "UNSUSPEND";
            //add into history
            $this->subscriptionHistoryRepository->addNewSubscriptionHistory(
                $subscriptionId,
                SaasHelper::getSubscriptionActionKey($historyAction),
                null,
                null,
                $initiator
            );
            //update subscription
            $result = $this->subscriptionUserRepository->updateSubscription(
                $subscriptionId,
                ["is_suspended" => $isSuspended, "updated_by"  => $initiator]
            );
        } catch (Exception $e) {
            Log::error("Error suspend / unsuspend, caused by ", [
                "subscriptionId"    => $subscriptionId,
                "error"     => $e->getMessage(),
            ]);
            DB::rollBack();
            return null;
        }

        DB::commit();
        return $result;
    }

    /**
     * =============================================
     * UNSUBSCRIBE
     * =============================================
     */
    public function unsubscribe($subscriptionId, $initiator = "system"): ?SubscriptionUser
    {
        DB::beginTransaction();
        try {
            //add into history
            $this->subscriptionHistoryRepository->addNewSubscriptionHistory(
                $subscriptionId,
                SaasHelper::getSubscriptionActionKey("UNSUBSCRIBE"),
                null,
                null,
                $initiator
            );

            // do your logic about unsubscribe here
            // for me unsubs mean set the expired date to right now
            $result =  $this->subscriptionUserRepository->updateSubscription(
                $subscriptionId,
                ["expired_date" => Carbon::now(), "updated_by"  => $initiator]
            );
        } catch (Exception $e) {
            Log::error("Error unsubsribe, caused by ", [
                "subscriptionId"    => $subscriptionId,
                "error"             => $e->getMessage(),
            ]);
            DB::rollBack();
            return null;
        }

        DB::commit();
        return $result;
    }

    /**
     * =============================================
     *      ADD NEW SUBSCRIPTION / RESUBSCRIBE
     * =============================================
     */
    public function subscribe($userId, $packageId, $paymentReference = "manual", $isRecurring = false, $initiator = "system"): ?SubscriptionUser
    {
        DB::beginTransaction();
        try {
            //get the package detail
            $package = $this->subscriptionMasterRepository->getPackageById($packageId);
            if (is_null($package)) {
                throw new Exception("Invalid package Id : $packageId",);
            }

            //check if user is valid and exists
            $user = $this->userRepository->getUserById($userId);
            if (is_null($user)) {
                throw new Exception("Invalid user Id : $userId",);
            }

            //check if subscription for this user is already exists or not
            $subscriptionData = $this->subscriptionUserRepository->findByUserIdAndPackageId($userId, $packageId);

            //create new subscription if not exists
            if (is_null($subscriptionData)) {
                $expiredDate = $isRecurring ? NULL : $this->calculateNewExpiredDate(Carbon::now(), $package->package_duration_days);
                $subscriptionData = $this->subscriptionUserRepository->createSubscription($userId, $packageId, Carbon::now(), $expiredDate, false, $initiator);
            } else {
                //update expired date if already exists
                // check fist if current subscription is still active
                if($subscriptionData->isExpired()){
                    Log::debug("SUBSCRIPTION INI EXPIRED LOH, KOK BISA? ", [
                        "EXPIRED_DATE"    => $subscriptionData->expired_date,
                        "ISEXPIRED?"    => ($subscriptionData->expired_date > now()),
                    ]);
                    $startDate  =   Carbon::now();
                }
                else{
                    Log::debug("SUBSCRIPTION INI TIDAK EXPIRED");
                    $startDate  = $subscriptionData->expired_date;
                }

                $newExpiredDate = $isRecurring ? NULL : $this->calculateNewExpiredDate($startDate, $package->package_duration_days);

                $subscriptionData = $this->subscriptionUserRepository->updateSubscription($subscriptionData->id, [
                    "start_date"  =>  $startDate,
                    "expired_date"  =>  $newExpiredDate,
                    "updated_by"    =>  $initiator
                ]);
            }

            //add into subscription history
            $this->subscriptionHistoryRepository->addNewSubscriptionHistory(
                $subscriptionData->id,
                SaasHelper::getSubscriptionActionKey("SUBSCRIBE"),
                $package->package_price,
                $paymentReference,
                $initiator
            );

            DB::commit();
            return $subscriptionData;

        } catch (Exception $e) {
            Log::error("Error creating new subscription, caused by ", [
                "userId"            => $userId,
                "packageId"         => $packageId,
                "isRecurring"       => $isRecurring,
                "paymentReference"  => $paymentReference,
                "initiator"         => $initiator,
                "error"             => $e->getMessage(),
            ]);
            DB::rollBack();
            return null;
        }
    }

    private function calculateNewExpiredDate($oldExpiredDate, $durationDays)
    {
        // Convert the old expiration date to a Carbon instance
        $oldDate = Carbon::parse($oldExpiredDate);

        // Add the duration days to the old expiration date
        $newExpiredDate = $oldDate->addDays($durationDays);

        Log::debug("CALCULATING NEW EXPIRED DATE", [
            "oldExpiredDate"    => $oldExpiredDate,
            "oldDate"           => $oldDate,
            "durationDays"      => $durationDays,
            "newExpiredDate"    => $newExpiredDate,
        ]);

        // Return the new expiration date
        return $newExpiredDate;
    }
}
