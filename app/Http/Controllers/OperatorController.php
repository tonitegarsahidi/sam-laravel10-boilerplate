<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function index(Request $request){

        // dd(auth()->user()->roles());
        return view('admin.pages.operator.index', [
            'message' => "Hello Operator, you are a good operator, thank you",
        ]);

    }
}
