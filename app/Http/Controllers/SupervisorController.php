<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function index(Request $request){

        return view('admin.pages.supervisor.index', [
            'message' => "Hello Supervisor, Keep being a good supervisor, thank you",
        ]);

    }
}
