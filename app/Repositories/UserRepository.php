<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository
{
    public function getAllUsers(int $perPage = 10): LengthAwarePaginator
    {
        return User::orderBy("is_active")->with('roles')->paginate($perPage);
    }

    public function getUserById(int $userId): ?User
    {
        return User::find($userId);
    }
}
