<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\UserRepository;
use App\Repositories\RoleUserRepository;

class UserService
{
    private $userRepository;
    private $roleUserRepository;

    /**
     * =============================================
     *  constructor
     * =============================================
     */
    public function __construct(UserRepository $userRepository, RoleUserRepository $roleUserRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleUserRepository = $roleUserRepository;
    }

    /**
     * =============================================
     *  list all user along with filter, sort, etc
     * =============================================
     */
    public function listAllUser($perPage, string $sortField = null, string $sortOrder = null, string $keyword = null): LengthAwarePaginator
    {
        $perPage = !is_null($perPage) ? $perPage : config('constant.CRUD.PER_PAGE');
        return $this->userRepository->getAllUsers($perPage, $sortField, $sortOrder, $keyword);
    }

    /**
     * =============================================
     * get single user data
     * =============================================
     */
    public function getUserDetail($userId): ?User
    {
        return $this->userRepository->getUserById($userId);
    }


    /**
     * =============================================
     * Check if certain username is exists or not
     * YOU CAN ALSO BLACKLIST some email in this logic
     * =============================================
     */
    public function checkUserExist(string $email): bool{
        return $this->userRepository->isUsernameExist($email);
    }

    /**
     * =============================================
     * process add new user to database
     * =============================================
     */
    public function addNewUser(array $validatedData)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->createUser($validatedData);
            $this->userRepository->syncRoles($user, $validatedData['roles']);
            DB::commit();
            return $user;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Failed to save new user to database: {$exception->getMessage()}");
            return null;
        }
    }

    /**
     * =============================================
     * process update user data
     * =============================================
     */
    public function updateUser(array $validatedData, $id)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);

            $this->userRepository->update($id, $validatedData);
            if (isset($validatedData['roles'])) {
                $this->userRepository->syncRoles($user, $validatedData['roles']);

            }
            DB::commit();
            return $user;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Failed to update user in the database: {$exception->getMessage()}");
            return null;
        }
    }

    /**
     * =============================================
     * process delete user
     * =============================================
     */
    public function deleteUser($userId): ?bool
    {
        DB::beginTransaction();
        try {
            $this->roleUserRepository->deleteRoleUserByUserId($userId);
            $this->userRepository->deleteUserById($userId);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Failed to delete user with id $userId: {$exception->getMessage()}");
            return false;
        }
    }
}
