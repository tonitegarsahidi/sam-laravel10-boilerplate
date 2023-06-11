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

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return view('admin.template-index', [
            'user' => $request->user(),
        ]);

    }

    public function blank(Request $request){

        return view('admin.pages.blank.index', [
            'user' => $request->user(),
        ]);

    }
}
