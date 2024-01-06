<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

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
            $queryResult->whereRaw('lower(name) LIKE ?',['%'.strtolower($keyword).'%'])
                ->orWhereRaw('lower(email) LIKE ?',['%'.strtolower($keyword).'%']);
        }

        $paginator = $queryResult->paginate($perPage);
        $paginator->withQueryString();

        return $paginator;
    }

    public function getUserById(int $userId): ?User
    {
        return User::find($userId);
    }
}
