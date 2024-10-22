<?php

namespace App\Http\Controllers;

use App\Helpers\AlertHelper;
use App\Http\Requests\UserProfileUpdateRequest;
use App\Services\ImageUploadService;
use App\Services\UserProfileService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

    /**
     * ################################################
     *      THIS IS USERPROFILE CONTROLLER
     * handles basic things for userprofile operations
     * mostly on user avatar and user profile data.
     * ################################################
     */
class UserProfileController extends Controller
{

    private $userProfileService;
    private $imageUploadService;
    private $mainBreadcrumbs;


    public function __construct(UserProfileService $userProfileService, ImageUploadService $imageUploadService)
    {
        $this->userProfileService = $userProfileService;
        $this->imageUploadService = $imageUploadService;
        // Store common breadcrumbs in the constructor
        $this->mainBreadcrumbs = [
            'User Profile' => route('user.setting.index')
        ];
    }

    /**
     * =============================================
     * load user data and userProfile data (if any)
     * then display it in form
     * =============================================
     */
    public function index(Request $request): View
    {
        //list of countries example
        $countries = config('constant.COUNTRIES');


        //get user Id
        $profile = $this->userProfileService->getUserProfile(Auth::user()->id);
        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['My Profile' => null]);

        // dd($profile);
        $alerts = AlertHelper::getAlerts();

        return view('admin.pages.setting.userprofile-index', compact('profile', 'breadcrumbs', 'countries', 'alerts'));
    }

    /**
     * =============================================
     *     process update user and userProfile data
     * =============================================
     */
    public function updateOrCreate(UserProfileUpdateRequest $request)
    {
        // The validated data will be available via $request->validated()
        $validated = $request->validated();
        $userId = Auth::user()->id;

        // Handle the profile picture upload if a new file is provided
        try {
            if ($request->hasFile('profile_picture')) {
                $path = $this->imageUploadService->uploadImage($request->file('profile_picture'), "profpic");
                $validated['profile_picture'] = $path;
            }
            else{
                $validated['profile_picture'] = null;
            }

            // Update or create user profile
            $result = $this->userProfileService->updateOrCreate($userId, $validated);

            // Create success or failure alert
            $alert = $result
                ? AlertHelper::createAlert('success', 'Your User Profile was successfully updated.')
                : AlertHelper::createAlert('danger', 'Your User Profile failed to be updated.');

        } catch (Exception $e) {
            // Handle any exceptions (e.g. upload errors)
            $alert = AlertHelper::createAlert('danger', 'Ooops An error occurred: ' . $e->getMessage());
        }

        // Redirect back with the alert
        return redirect()->route('user.profile.index')->with(['alerts' => [$alert]]);
    }
}
