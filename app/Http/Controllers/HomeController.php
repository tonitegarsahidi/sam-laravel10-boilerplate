<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function checkAuth(Request $request){

        return view('admin.template-index', [
            'user' => $request->user(),
        ]);

    }

    public function index(Request $request){

        //will redirect to dashboard if user already logged in
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('landing.index', [
            'user' => $request->user(),
        ]);

    }

    public function blank(Request $request){

        return view('admin.pages.blank.index', [
            'user' => $request->user(),
        ]);

    }
}
