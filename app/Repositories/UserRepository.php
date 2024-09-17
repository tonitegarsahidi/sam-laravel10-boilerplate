<?php

namespace App\Repositories;

use App\Models\User;
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

    public function getUserById(int $userId): ?User
    {
        return User::with('roles')->find($userId);
    }

    public function createUser($data)
    {
        return User::create([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'password'      => Hash::make($data['password']),
            'phone_number'  => $data['phone_number'],
            'is_active'     => $data['is_active'],
        ]);
    }

    public function syncRoles(User $user, $roles)
    {
        $user->roles()->sync($roles);
    }

    public function deleteUserById(int $userId): ?bool
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
