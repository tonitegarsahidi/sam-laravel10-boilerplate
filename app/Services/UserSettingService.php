<?php

namespace App\Services;

use App\Exceptions\IncorrectPasswordException;
use App\Http\Requests\UserAddRequest;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\UserRepository;
use App\Repositories\RoleUserRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserSettingService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * ==============================================
     * To check, if current user password is match
     * ==============================================
     */
    public function checkUserPasswordMatch($userId, $userPassword){

        return false;
    }

    /**
     * ==============================================
     * Change specific user password
     * ==============================================
     */
    public function changePassword(string $currentPassword, string $newPassword)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Check the type of $user
        if (!$user instanceof \App\Models\User) {
            throw new Exception('The authenticated user is not an instance of the User model. Make sure you login', 40112);
        }

       // Check if the current password matches the user's actual current password
       if (!Hash::check($currentPassword, $user->password)) {
        // Password does not match, throw custom exception
        throw new IncorrectPasswordException('Current password is incorrect.');
        }

        // Password matches, so update the password
        $user->password = Hash::make($newPassword);
        $user->save();

        return true;
    }





}
