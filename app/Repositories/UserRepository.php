<?php

namespace App\Repositories;

use App\Models\RoleUser;
use App\Models\User;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function getAllUsers(int $perPage = 10, string $sortField = null, string $sortOrder = null, String $keyword = null): LengthAwarePaginator
    {
        $queryResult = User::query();

        if (!is_null($sortField) && !is_null($sortOrder)) {
            $queryResult->orderBy($sortField, $sortOrder);
        } else {
            $queryResult->orderBy("is_active", "desc");
        }

        $queryResult->with('roles');

        if (!is_null($keyword)) {
            $queryResult->whereRaw('lower(name) LIKE ?', ['%' . strtolower($keyword) . '%'])
                ->orWhereRaw('lower(email) LIKE ?', ['%' . strtolower($keyword) . '%']);
        }

        $paginator = $queryResult->paginate($perPage);
        $paginator->withQueryString();

        return $paginator;
    }

    public function isUsernameExist(String $username){
        return User::where('email', $username)->exists();
    }

    public function getUserById($userId): ?User
    {
        return User::with('roles')->find($userId);
    }

    public function createUser($data)
    {
        return User::create($data);
    }

    public function update($userId, $data)
    {
        // Find the user profile by user_id
        $userProfile = User::where('id', $userId)->first();
        if ($userProfile) {
            // Update the profile with the provided data
            $userProfile->update($data);
            return $userProfile;
        } else {
            throw new Exception("User Profile not found");
        }
    }

    public function syncRoles(User $user, $roles)
    {
        //delete all roles by this user
        RoleUser::where('user_id', $user->id)->delete();

        //create new roles for this user
        foreach ($roles as $roleId) {
            RoleUser::create(['user_id' => $user->id, 'role_id' => $roleId]);
        }
    }
    public function deleteUserById($userId): ?bool

    {
        try {
            $user = User::findOrFail($userId); // Find the user by ID
            $user->delete(); // Delete the user
            return true; // Return true on successful deletion
        } catch (\Exception $e) {
            // Handle any exceptions, such as user not found
            throw $e; // Return false if deletion fails
        }
    }
}
