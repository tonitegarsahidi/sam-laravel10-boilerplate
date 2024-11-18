<?php

namespace App\Repositories\Saas;

use App\Models\Saas\SubscriptionMaster;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class SubscriptionMasterRepository
{
    public function getAllPackages(int $perPage = 10, string $sortField = null, string $sortOrder = null, String $keyword = null): LengthAwarePaginator
    {
        $queryResult = SubscriptionMaster::query();

        if (!is_null($sortField) && !is_null($sortOrder)) {
            $queryResult->orderBy($sortField, $sortOrder);
        } else {
            $queryResult->orderBy("is_active", "desc");
        }

        if (!is_null($keyword)) {
            $queryResult->whereRaw('lower(alias) LIKE ?', ['%' . strtolower($keyword) . '%'])
                ->orWhereRaw('lower(package_name) LIKE ?', ['%' . strtolower($keyword) . '%'])
                ->orWhereRaw('lower(package_description) LIKE ?', ['%' . strtolower($keyword) . '%']);

            // For numeric columns, use direct comparison
            if (is_numeric($keyword)) {
                $queryResult->orWhere('id', $keyword)
                    ->orWhere('package_price', $keyword);
            }
        }

        $paginator = $queryResult->paginate($perPage);
        $paginator->withQueryString();

        return $paginator;
    }

    public function findOrFail($id)
    {
        return SubscriptionMaster::findOrFail($id);
    }


    public function getPackageById($id): ?SubscriptionMaster
    {
        return SubscriptionMaster::find($id);
    }

    public function createPackage($data)
    {
        return SubscriptionMaster::create($data);
    }

    public function updatePackage($id, $data)
    {
        // Find the data based on the id
        $updatedData = SubscriptionMaster::where('id', $id)->first();

        // if data with such id exists
        if ($updatedData) {
            // Update the profile with the provided data
            $updatedData->update($data);
            return $updatedData;
        } else {
            throw new Exception("Subsription Master data not found");
        }
    }


    public function deletePackageById($id): ?bool
    {
        try {
            $user = SubscriptionMaster::findOrFail($id); // Find the data by ID
            $user->delete(); // Delete the data
            return true; // Return true on successful deletion
        } catch (\Exception $e) {
            // Handle any exceptions, such as data not found
            throw new Exception("Subsription Master data not found");
        }
    }
}
