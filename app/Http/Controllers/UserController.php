<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){

        return view('admin.pages.user.index', [
            'message' => "Hello User, Thanks for using our products",
        ]);

    }
}
