<?php

namespace App\Services\Saas;

use App\Models\Package;
use App\Models\Saas\SubscriptionHistory;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Saas\SubscriptionHistoryRepository;
use Illuminate\Http\Request;

class SubscriptionHistoryService
{
    private $SubscriptionHistoryRepository;

    /**
     * =============================================
     *  constructor
     * =============================================
     */
    public function __construct(SubscriptionHistoryRepository $SubscriptionHistoryRepository)
    {
        $this->SubscriptionHistoryRepository = $SubscriptionHistoryRepository;
    }

    /**
     * =============================================
     *  list all package along with filter, sort, etc
     * =============================================
     */
    public function listAllPackage($perPage, string $sortField = null, string $sortOrder = null, string $keyword = null): LengthAwarePaginator
    {
        $perPage = !is_null($perPage) ? $perPage : config('constant.CRUD.PER_PAGE');

        return $this->SubscriptionHistoryRepository->getAllPackages($perPage, $sortField, $sortOrder, $keyword);
    }

    /**
     * =============================================
     * get single package data
     * =============================================
     */
    public function getPackageDetail($packageId): ?SubscriptionHistory
    {
        return $this->SubscriptionHistoryRepository->getPackageById($packageId);
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
            $package = $this->SubscriptionHistoryRepository->createPackage($validatedData);
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

            $updatedPackage = $this->SubscriptionHistoryRepository->updatePackage($id, $validatedData);

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

            $this->SubscriptionHistoryRepository->deletePackageById($packageId);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Failed to delete package with id $packageId: {$exception->getMessage()}");
            return false;
        }
    }
}
