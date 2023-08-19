<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository
{
    public function getAllUsers(int $perPage = 10, string $sortField = null, string $sortOrder = null): LengthAwarePaginator
    {
        if(!is_null($sortField) && !is_null($sortOrder)){
            $queryResult =  User::orderBy($sortField, $sortOrder)->orderBy("is_active")->with('roles')->paginate($perPage)->withQueryString();
        }
        else{
            $queryResult =  User::orderBy("is_active", "desc")->with('roles')->paginate($perPage)->withQueryString();
        }

        return $queryResult;
    }

    public function getUserById(int $userId): ?User
    {
        return User::find($userId);
    }
}
