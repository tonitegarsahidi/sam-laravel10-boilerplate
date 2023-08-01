<?php
namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function listAllUser(int $perPage): LengthAwarePaginator
    {
        return $this->userRepository->getAllUsers($perPage);
    }

}
