<?php
namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function listAllUser(int $perPage, string $sortField=null, string $sortOrder=null, string $keyword = null): LengthAwarePaginator
    {
        return $this->userRepository->getAllUsers($perPage, $sortField, $sortOrder, $keyword);
    }

    public function getUserDetail(int $userId): User
    {
        return $this->userRepository->getUserById($userId);
    }

    public function deleteConfirm(int $userId): User
    {
        return $this->userRepository->getUserById($userId);
    }

}
