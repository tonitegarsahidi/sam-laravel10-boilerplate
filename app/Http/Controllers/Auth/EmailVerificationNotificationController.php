<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailVerifyEmailJob;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmailVerificationNotificationController extends Controller
{
    /**
     * =================================================
     *      Send a new email verification notification.
     * =================================================
     */
    public function showForm(): View
    {
        return view('admin.auth.resend-verification');
    }

    /**
     * =================================================
     *      Show Verification Success
     * =================================================
     */
    public function showVerificationSuccess(): View
    {
        return view('admin.auth.verification-success');
    }

    /**
     * =================================================
     *      Show Verification Failed\
     * =================================================
     */
    public function showVerificationFailed(): View
    {
        return view('admin.auth.verification-failed');
    }

    /**
     * =================================================
     *      Send a new email verification notification.
     * =================================================
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the email input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Retrieve the user by email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists and has not verified their email
        if ($user && $user->hasVerifiedEmail()) {
            return back()->with('status', 'Your email has already been verified, you can now login.');
        }

        if ($user) {
            // Send email verification notification
            SendEmailVerifyEmailJob::dispatch($user);
            return back()->with('status', 'Verification link sent to your email.');
        }

        return back()->withErrors(['email' => 'No user found with that email address.']);
    }
}
