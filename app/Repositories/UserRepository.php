<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository
{
    public function getAllUsers(int $perPage = 10, string $sortField, string $sortOrder): LengthAwarePaginator
    {
        if(!is_null($sortField) && !is_null($sortOrder)){
            $queryResult =  User::orderBy($sortField, $sortOrder)->orderBy("is_active")->with('roles')->paginate($perPage);
        }
        else{
            $queryResult =  User::orderBy("is_active", "asc")->with('roles')->paginate($perPage);
        }

        return $queryResult;
    }

    public function getUserById(int $userId): ?User
    {
        return User::find($userId);
    }
}
