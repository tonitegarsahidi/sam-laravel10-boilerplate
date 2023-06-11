<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request){

        return view('admin.pages.admin.index', [
            'message' => "Hello Admin, this is admin page. This page can only be accessed if using Admin Login Credentials",
        ]);

    }
}
