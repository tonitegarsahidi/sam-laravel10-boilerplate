<?php

namespace App\Repositories\Saas;

use App\Models\Saas\SubscriptionUser;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class SubscriptionUserRepository
{
    public function getAllSubscription(int $perPage = 10, string $sortField = null, string $sortOrder = null, String $keyword = null): LengthAwarePaginator
    {
        $queryResult = SubscriptionUser::query()

            ->join('users', 'subscription_user.user_id', '=', 'users.id')
            ->join('subscription_master', 'subscription_user.package_id', '=', 'subscription_master.id');

        if (!is_null($sortField) && !is_null($sortOrder)) {
            $queryResult->orderBy($sortField, $sortOrder);
        } else {
            $queryResult->orderBy("subscription_user.expired_date", "desc");
        }

        if (!is_null($keyword)) {
            $queryResult->whereRaw('lower(users.email) LIKE ?', ['%' . strtolower($keyword) . '%'])
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


    public function getPackageById($id): ?SubscriptionUser
    {
        return SubscriptionUser::find($id);
    }

    public function createPackage($data)
    {
        return SubscriptionUser::create($data);
    }

    public function updatePackage($id, $data)
    {
        // Find the data based on the id
        $updatedData = SubscriptionUser::where('id', $id)->first();

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
            $user = SubscriptionUser::findOrFail($id); // Find the data by ID
            $user->delete(); // Delete the data
            return true; // Return true on successful deletion
        } catch (\Exception $e) {
            // Handle any exceptions, such as data not found
            throw new Exception("Subsription Master data not found");
        }
    }
}
