<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('admin.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'agree' => 'accepted',
        ], [
            'agree.accepted' => 'You need to agree to our terms and conditions.',
        ]);


        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_active' => config('constant.NEW_USER_STATUS_ACTIVE'),
            ]);

            //find the roles ID
            $roleId = Role::where('role_code', '=', config('constant.NEW_USER_DEFAULT_ROLES'))->first("id")->id;

            //add the default role to the new user
            RoleUser::create([
                'user_id'   => $user->id,
                'role_id'   => $roleId,
            ]);

            DB::commit();

            event(new Registered($user));



            //jika user auto aktif
            if (config('constant.NEW_USER_STATUS_ACTIVE')) {
                Auth::login($user);
                return redirect(RouteServiceProvider::HOME);
            } else {
                return redirect(RouteServiceProvider::VERIFY_EMAIL);
            }


        } catch (Exception $e) {
            Log::error("error in registration : ", ["exception" => $e]);
            DB::rollback();
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
