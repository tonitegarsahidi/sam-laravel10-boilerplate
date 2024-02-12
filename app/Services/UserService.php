<?php

namespace App\Services;

use App\Http\Requests\UserAddRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function listAllUser(int $perPage, string $sortField = null, string $sortOrder = null, string $keyword = null): LengthAwarePaginator
    {
        return $this->userRepository->getAllUsers($perPage, $sortField, $sortOrder, $keyword);
    }

    public function getUserDetail(int $userId): User
    {
        return $this->userRepository->getUserById($userId);
    }

    public function addNewUser($request)
    {
        DB::beginTransaction();
        try {
            // Validation passed, create and store the user
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->password);
            $user->phone_number = $request->input('phone_number');
            $user->is_active = $request->input('is_active');
            $user->save();

            // Attach roles
            $user->roles()->sync($request->input('roles'));

            DB::commit();
            return $user;
        } catch (\Exception $exception) {
            //throw $th;
            DB::rollBack();

            Log::error("Failed to save new users to database : ", [
                "request" => $request,
                "caused" => $exception->getMessage()
            ]);

            return null;
        }
    }

    public function deleteConfirm(int $userId): User
    {
        return $this->userRepository->getUserById($userId);
    }
}
