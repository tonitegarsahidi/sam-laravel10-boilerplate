<?php

namespace App\Repositories\Saas;

use App\Models\Saas\SubscriptionUser;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class SubscriptionUserRepository
{
    public function getAllSubscription(int $perPage = 10, string $sortField = null, string $sortOrder = null, String $keyword = null, String $userId = null): LengthAwarePaginator
    {
        $queryResult = SubscriptionUser::query()

            ->join('users', 'subscription_user.user_id', '=', 'users.id')
            ->join('subscription_master', 'subscription_user.package_id', '=', 'subscription_master.id')
            ->select([
                'subscription_user.id as id', // Alias to avoid ambiguity
                'subscription_user.expired_date',
                'subscription_user.start_date',
                'subscription_user.is_suspended',
                'users.email as email',
                'users.id as userId',
                'subscription_master.id as packageId',
                'subscription_master.package_name as package',
            ]);
        if(!is_null($userId)){
            $queryResult->where('users.id', $userId);
        }

        if (!is_null($sortField) && !is_null($sortOrder)) {
            $queryResult->orderBy($sortField, $sortOrder);
        } else {
            $queryResult->orderBy("subscription_user.expired_date", "desc");
        }

        if (!is_null($keyword)) {
            $queryResult->whereRaw('lower(users.email) LIKE ?', ['%' . strtolower($keyword) . '%'])
                ->orWhereRaw('lower(users.name) LIKE ?', ['%' . strtolower($keyword) . '%'])
                ->orWhereRaw('lower(subscription_master.package_name) LIKE ?', ['%' . strtolower($keyword) . '%'])
                ->orWhereRaw('DATE_FORMAT(subscription_user.expired_date, "%Y-%m-%d") LIKE ?', ['%' . $keyword . '%'])
                ->orWhereRaw('DATE_FORMAT(subscription_user.start_date, "%Y-%m-%d") LIKE ?', ['%' . $keyword . '%']);
        }

        $paginator = $queryResult->paginate($perPage);
        $paginator->withQueryString();

        return $paginator;
    }

    public function findOrFail($id)
    {
        return SubscriptionUser::findOrFail($id);
    }


    public function getSubscriptionById($id): ?SubscriptionUser
    {
        return SubscriptionUser::find($id);
    }

    public function createSubscription($userId, $packageId, $startDate, $expiredDate = null, $isSuspended = false, $initiator = "system")
    {
        $data = [
            "user_id"       => $userId,
            "package_id"    => $packageId,
            "start_date"    => $startDate,
            "expired_date"  => $expiredDate,
            "is_suspended"  => $isSuspended,
            "created_by"    => $initiator,
            "updated_by"    => $initiator,
        ];
        return SubscriptionUser::create($data);
    }

    //will Return null if none
    public function findByUserIdAndPackageId($userId, $packageId): ?SubscriptionUser
    {
        return SubscriptionUser::where('user_id', $userId)->where("package_id", $packageId)->first();
    }

    /**============================================
     * UPDATE THE USER'S SUBSCRIPTION
     * used for :
     * - suspend,
     * - unsuspend,
     * - unsubscribe
     * ============================================
     */
    public function updateSubscription($id, $data, $initiator = "system")
    {
        // Find the data based on the id
        $updatedData = SubscriptionUser::where('id', $id)->first();

        // if data with such id exists
        if ($updatedData) {
            // Update the profile with the provided data
            $updatedData->update($data);
            return $updatedData;
        } else {
            throw new Exception("Subsription User data not found");
        }
    }
}
