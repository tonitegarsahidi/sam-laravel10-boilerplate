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
    private $imageUploadService;

    public function __construct(UserProfileRepository $userProfileRepository, ImageUploadService $imageUploadService)
    {
        $this->userProfileRepository = $userProfileRepository;
        $this->imageUploadService = $imageUploadService;
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
                "date_of_birth"     => $validatedData['date_of_birth'] ?? null,
                "gender"            => $validatedData['gender'] ?? null,
                "address"           => $validatedData['address'] ?? null,
                "city"              => $validatedData['city'] ?? null,
                "country"           => $validatedData['country'] ?? null,
                "profile_picture"   => $validatedData['profile_picture'] ?? null,
            ], $validatedData);

            if (is_null($userProfile)) {
                //create new entry
                $profile = $this->userProfileRepository->create($profileData);
            } else {
                //check if there is profile picture update and there is old profile picture
                if(!is_null($validatedData['profile_picture']) && !is_null($userProfile->profile_picture)){
                    Log::debug("delete old profile picture ".$userProfile->profile_picture." and replace it with ".$validatedData['profile_picture']);
                    $this->deleteOldProfilePicture($userProfile->profile_picture);
                }

                //update the entry
                $profile = $this->userProfileRepository->update($userId, $profileData);
            }
            DB::commit();
            return $profile;
        } catch (Exception $e) {
            DB::rollback();
            Log::error("message ".$e->getMessage());
            return false;
        }
    }

    public function deleteOldProfilePicture(string $fileUrl)
    {
        try {
            $this->imageUploadService->deleteImage($fileUrl);
            return true;

        } catch (Exception $e) {
            Log::error("Failed to Delete File ".$fileUrl, ["cause" => $e->getMessage()]);
            return false;
        }
    }
}
