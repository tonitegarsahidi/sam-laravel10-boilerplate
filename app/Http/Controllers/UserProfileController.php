<?php

namespace App\Http\Controllers;

use App\Helpers\AlertHelper;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UserProfileUpdateRequest;
use App\Services\UserProfileService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UserProfileController extends Controller
{

    private $userProfileService;
    private $mainBreadcrumbs;


    public function __construct(UserProfileService $userProfileService)
    {
        $this->userProfileService = $userProfileService;
        // Store common breadcrumbs in the constructor
        $this->mainBreadcrumbs = [
            'User Profile' => route('user.setting.index')
        ];
    }
    /**
     * Display the user's profile form.
     */
    public function index(Request $request): View
    {
        //list of countries
        $countries = config('constant.COUNTRIES');


        //get user Id
        $profile = $this->userProfileService->getUserProfile(Auth::user()->id);
        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['My Profile' => null]);

        // dd($profile);
        $alerts = AlertHelper::getAlerts();

        return view('admin.pages.setting.userprofile-index', compact('profile', 'breadcrumbs', 'countries', 'alerts'));
    }

    /**
     * Display the user's profile form.
     */
    public function updateOrCreate(UserProfileUpdateRequest $request)
    {
        // The validated data will be available via $request->validated()
        $validated = $request->validated();

        // Get the current authenticated userId
        $userid = Auth::user()->id;

        $result = $this->userProfileService->updateOrCreate($userid, $validated);


        $alert = $result
        ? AlertHelper::createAlert('success', 'Your User Profile successfully updated')
        : AlertHelper::createAlert('danger', 'Your User Profile failed to be updated');

        // dd($result);

        return redirect()->route('user.profile.index')->with(
            ['alerts' => [$alert]]);
    }
}
