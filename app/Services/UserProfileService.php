<?php

namespace App\Services;

use App\Http\Requests\UserProfileUpdateRequest;
use App\Models\UserProfile;
use App\Repositories\UserProfileRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserProfileService
{
    private $userProfileRepository;

    public function __construct(UserProfileRepository $userProfileRepository)
    {
        $this->userProfileRepository = $userProfileRepository;
    }

    /**
     * ==============================================
     * To check, if current user password is match
     * ==============================================
     */
    public function getUserProfile($userId): ?UserProfile
    {
        return $this->userProfileRepository->getProfile($userId);
    }


    public function updateOrCreate($userId, $validatedData)
    {

        try {
            DB::beginTransaction();

            //check if current user already has profile
            $userProfile = $this->userProfileRepository->getProfile($userId);


            $profileData = array_merge([
                "user_id"           => $userId,
                "date_of_birth"     => $data['date_of_birth'] ?? null,
                "gender"            => $data['gender'] ?? null,
                "address"           => $data['address'] ?? null,
                "city"              => $data['city'] ?? null,
                "country"           => $data['country'] ?? null,
                "profile_picture"   => $data['profile_picture'] ?? null,
            ], $validatedData);

            if (is_null($userProfile)) {
                //create new entry
                $profile = $this->userProfileRepository->create($profileData);
            } else {
                //update the entry
                $profile = $this->userProfileRepository->update($userId, $profileData);
            }
            DB::commit();
            return $profile;

        } catch (Exception $e) {
            DB::rollback();
            Log::error("message");
            return false;
        }
    }
}
