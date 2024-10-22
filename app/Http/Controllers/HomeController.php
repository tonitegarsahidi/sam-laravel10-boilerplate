<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * =============================================
     *      function which handle your / route
     *  based on login / not login
     * =============================================
     */
    public function index(Request $request){

        //will redirect to dashboard if user already logged in
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('landing.index', [
            'user' => $request->user(),
        ]);

    }

}
