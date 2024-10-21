<?php

namespace App\Repositories;

use App\Models\UserProfile;
use Exception;

class UserProfileRepository
{
    public function getProfile($userId = null): ?UserProfile
    {
        if (is_null($userId)) {
            return null;
        }

        $userProfile = UserProfile::where('user_id', $userId)->first();

        return $userProfile;
    }

    public function create($data)
    {
        return UserProfile::create($data);
    }

    public function update($userId, $data)
    {
        // Find the user profile by user_id
        $userProfile = UserProfile::where('user_id', $userId)->first();
        if ($userProfile) {
            // Update the profile with the provided data
            $userProfile->update([
                "date_of_birth"   => $data['date_of_birth'] ?? $userProfile->date_of_birth,
                "gender"          => $data['gender'] ?? $userProfile->gender,
                "address"         => $data['address'] ?? $userProfile->address,
                "city"            => $data['city'] ?? $userProfile->city,
                "country"         => $data['country'] ?? $userProfile->country,
                "profile_picture" => $data['profile_picture'] ?? $userProfile->profile_picture,
            ]);

            return $userProfile;
        } else {
            throw new Exception("User Profile not found");
        }
    }
}
