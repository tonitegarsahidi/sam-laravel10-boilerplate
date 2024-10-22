<?php

namespace App\Services;

use App\Exceptions\IncorrectPasswordException;
use App\Repositories\UserRepository;
use Exception;
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
            throw new Exception('The authenticated user is not an instance of the User model. Make sure you login');
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
