<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendResetPasswordEmailJob;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * =============================================
     * Display the password reset link request view.
     * =============================================
     */
    public function create(): View
    {
        return view('admin.auth.forgot-password');
    }

    /**
     * =============================================
     * Handle an incoming password reset link request.
     *=============================================
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if ($user) {
            Log::debug("Dispatching the Jobs");
            dispatch(new SendResetPasswordEmailJob($user->id));
        } else {
            // Handle the case where the user does not exist
            return back()->withErrors(['email' => 'No user found with this email.']);
        }

        // Send a response back
        return back()->with('status', __('We have emailed your password reset link! to '.$request->input('email')));
    }
}
