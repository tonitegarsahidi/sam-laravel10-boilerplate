<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    /**
     * =========================================================
     * Mark the authenticated user's email address as verified.
     * =========================================================
     */
    public function __invoke(Request $request): RedirectResponse
    {
        // Retrieve user based on ID in the request
        $user = User::find($request->route('id'));

        // Check if the user exists
        if (!$user) {
            return redirect()->route('verification.failed')->withErrors(['message' => 'User not found.']);
        }

        // Verify the hash to ensure the link is valid
        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            return redirect()->route('verification.failed')->withErrors(['message' => 'Invalid verification link.']);
        }

        // Check if the email has already been verified
        if ($user->hasVerifiedEmail()) {
            return redirect(RouteServiceProvider::VERIFY_EMAIL_SUCCESS)->with('status', 'Your email is already verified.');
        }

        // Verify the user's email
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
            return redirect(RouteServiceProvider::VERIFY_EMAIL_SUCCESS)->with('status', 'Email successfully verified!');
        }

        // If verification failed for any reason, redirect to the failed route
        return redirect()->route('verification.failed')->withErrors(['message' => 'Email verification failed.']);
    }
}
