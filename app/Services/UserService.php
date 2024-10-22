<?php

namespace App\Services;

use App\Http\Requests\UserAddRequest;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\UserRepository;
use App\Repositories\RoleUserRepository;
use Illuminate\Http\Request;

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
    public function listAllUser(int $perPage, string $sortField = null, string $sortOrder = null, string $keyword = null): LengthAwarePaginator
    {
        return $this->userRepository->getAllUsers($perPage, $sortField, $sortOrder, $keyword);
    }

    /**
     * =============================================
     * get single user data
     * =============================================
     */
    public function getUserDetail(int $userId): ?User
    {
        return $this->userRepository->getUserById($userId);
    }

    /**
     * =============================================
     * process add new user to database
     * =============================================
     */
    public function addNewUser(UserAddRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->createUser($request->validated());
            $this->userRepository->syncRoles($user, $request->input('roles'));
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
    public function updateUser($data, $id)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $this->userRepository->update($id, $data);
            if (isset($data['roles'])) {
                $user->roles()->sync($data['roles']);
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
    public function deleteUser(int $userId): ?bool
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
