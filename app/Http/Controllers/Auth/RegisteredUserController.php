<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\RoleMaster;
use App\Models\RoleUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\UserService;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * ======================================
     * Display the registration view.
     * ======================================
     */
    public function create(): View
    {
        return view('admin.auth.register');
    }

    /**
     * ======================================
     * Display the neecActivation view (after registration).
     * this is to info the user that
     * they need to wait for activation from Admin
     * before they can login and use the apps.
     * you can change the setting on 'config/constan'
     * ======================================
     */
    public function needActivation(): View
    {
        return view('admin.auth.need-activation');
    }

    /**
     * ============================================================
     * Handle an incoming registration request.
     * ============================================================
     *
     */
    public function store(Request $request): RedirectResponse
    {

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'agree' => 'accepted',
        ], [
            'agree.accepted' => 'You need to agree to our terms and conditions.',
        ]);


        //start insert operation
        try {
            DB::beginTransaction();

            //find the roles ID (defaults role)
            $roleId = RoleMaster::where('role_code', '=', config('constant.NEW_USER_DEFAULT_ROLES'))->first("id")->id;

            //insert into database
            $user = $this->userService->addNewUser(
                [
                    'name' => $validatedData["name"],
                    'email' => $validatedData["email"],
                    'password' => Hash::make($validatedData["password"]),
                    'is_active' => config('constant.NEW_USER_STATUS_ACTIVE'),
                    'roles'     => [$roleId]
                ]
            );

            DB::commit();

            event(new Registered($user));


            // HANDLE REDIRECTS AFTER USER REGISTER
            //if user auto active and no need to verify email
            if (config('constant.NEW_USER_STATUS_ACTIVE') && !config('constant.NEW_USER_NEED_VERIFY_EMAIL')) {
                Auth::login($user);
                return redirect(RouteServiceProvider::HOME);
            }
            //if new user mechanism not auto active (need admin activation)
            else  if (!config('constant.NEW_USER_STATUS_ACTIVE')) {
                return redirect(route('register.needactivation'));
            } else if (config('constant.NEW_USER_NEED_VERIFY_EMAIL')) {

                return redirect(route('verification.notice'));
            }
        } catch (Exception $e) {
            Log::error("error in registration : ", ["exception" => $e]);
            DB::rollback();
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
