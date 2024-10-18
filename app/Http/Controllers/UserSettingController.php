<?php
namespace App\Http\Controllers;

use App\Exceptions\IncorrectPasswordException;
use App\Helpers\AlertHelper;
use App\Helpers\ErrorHelper;
use App\Http\Requests\User\UserChangePasswordRequest;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserDetailRequest;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserListRequest;
use App\Models\User;
use App\Services\RoleMasterService;
use App\Services\UserService;
use App\Services\UserSettingService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserSettingController extends Controller
{
    private $userService;
    private $userSettingService;
    private $roleMasterService;
    private $mainBreadcrumbs;

    public function __construct(UserService $userService,
                                UserSettingService $userSettingService,
                                RoleMasterService $roleMasterService)
    {
        $this->userService = $userService;
        $this->userSettingService = $userSettingService;
        $this->roleMasterService = $roleMasterService;

        // Store common breadcrumbs in the constructor
        $this->mainBreadcrumbs = [
            'User Setting' => route('user.setting.index')
        ];
    }


    public function index()
    {
        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Setting' => null]);

        return view('admin.pages.setting.index', compact('breadcrumbs'));
    }

    /**
     * =======================================
     * Load change passsword Page
     * =======================================
     */
    public function changePasswordPage()
    {

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Change Password' => null]);

        $alerts = AlertHelper::getAlerts();

        return view('admin.pages.setting.change-password', compact('breadcrumbs', 'alerts'));
    }

    /**
     * =======================================
     * Do action change password is here
     * =======================================
     */
    public function changePasswordDo(UserChangePasswordRequest $request)
    {
        $breadcrumbs = [
            'User Setting' => route('user.setting.index'),
            'Change Password' => null,
        ];

        try {
            $this->userSettingService->changePassword($request->currentpassword, $request->newpassword);
            $alert = AlertHelper::createAlert('success', 'Your password successfully changed');

        } catch (IncorrectPasswordException $e) {
            // Handle the custom exception by returning a view with a custom error
            $alert = AlertHelper::createAlert('danger', ErrorHelper::makeErrorsText('WRONG_CURRENT_PASSWORD'));
        } catch (\Exception $e) {
            // Handle other exceptions
            Log::error(ErrorHelper::makeErrorsText('GENERIC_ERROR')." Caused by ".$e);
            $alert = AlertHelper::createAlert('danger', ErrorHelper::makeErrorsText('GENERIC_ERROR'));
        }

        return redirect(route('user.setting.changePassword'))->with(['alerts' => [$alert]]);

    }

      /**
     * =======================================
     * Load change PROFILE Page
     * =======================================
     */
    public function changeProfilePage()
    {

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Change Profile' => null]);

        $alerts = AlertHelper::getAlerts();

        return view('admin.pages.setting.change-profile', compact('breadcrumbs', 'alerts'));
    }


      /**
     * =======================================
     * Load change PROFILE Page
     * =======================================
     */
    public function changeProfileDo()
    {

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Change Profile DO' => null]);

        $alerts = AlertHelper::getAlerts();

        return view('admin.pages.setting.change-profile', compact('breadcrumbs', 'alerts'));
    }

}
