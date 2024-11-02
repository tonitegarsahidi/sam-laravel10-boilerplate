<?php

namespace App\Services\Saas;

use App\Models\Package;
use App\Models\Saas\SubscriptionUser;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Saas\SubscriptionUserRepository;
use Illuminate\Http\Request;

class SubscriptionUserService
{
    private $subscriptionUserRepository;

    /**
     * =============================================
     *  constructor
     * =============================================
     */
    public function __construct(SubscriptionUserRepository $subscriptionUserRepository)
    {
        $this->subscriptionUserRepository = $subscriptionUserRepository;
    }

    /**
     * =============================================
     *  list all package along with filter, sort, etc
     * =============================================
     */
    public function listAllSubscription($perPage, string $sortField = null, string $sortOrder = null, string $keyword = null): LengthAwarePaginator
    {
        $perPage = !is_null($perPage) ? $perPage : config('constant.CRUD.PER_PAGE');

        return $this->subscriptionUserRepository->getAllSubscription($perPage, $sortField, $sortOrder, $keyword);
    }

    /**
     * =============================================
     * get single package data
     * =============================================
     */
    public function getPackageDetail($packageId): ?SubscriptionUser
    {
        return $this->subscriptionUserRepository->getPackageById($packageId);
    }



    /**
     * =============================================
     * process add new package to database
     * =============================================
     */
    public function addNewPackage(array $validatedData)
    {
        DB::beginTransaction();
        try {
            $package = $this->subscriptionUserRepository->createPackage($validatedData);
            DB::commit();
            return $package;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Failed to save package data to database: {$exception->getMessage()}");
            return null;
        }
    }

    /**
     * =============================================
     * process update package data
     * =============================================
     */
    public function updatePackage(array $validatedData, $id)
    {
        DB::beginTransaction();
        try {

            $updatedPackage = $this->subscriptionUserRepository->updatePackage($id, $validatedData);

            DB::commit();
            return $updatedPackage;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Failed to update package in the database: {$exception->getMessage()}");
            return null;
        }
    }


    /**
     * =============================================
     * process CHECK IF A package can be deleted
     * =============================================
     */
    public function isDeleteable($packageId): ?bool{

        // PUT YOUR LOGIC ABOUT A DATA CAN BE DELETED OR NOT HERE

        return true;
    }


    /**
     * =============================================
     * process delete package
     * =============================================
     */
    public function deletePackage($packageId): ?bool
    {
        DB::beginTransaction();
        try {
            if(!$this->isDeleteable($packageId)){
                throw("This data cannot be deleted");
            }

            $this->subscriptionUserRepository->deletePackageById($packageId);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Failed to delete package with id $packageId: {$exception->getMessage()}");
            return false;
        }
    }
}
