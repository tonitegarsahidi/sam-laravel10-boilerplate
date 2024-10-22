<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupervisorController extends Controller
{

    /**
     * =============================================
     *      Handle sample pages
     *      which can only be accessed
     *      by this role supervisor
     * =============================================
     */
    public function index(Request $request){

        return view('admin.pages.supervisor.index', [
            'message' => "Hello Supervisor, Keep being a good supervisor, thank you",
        ]);

    }
}
