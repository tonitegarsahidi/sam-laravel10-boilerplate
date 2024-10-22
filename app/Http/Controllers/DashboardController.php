<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /**
     * =============================================
     *      view dashboard pages
     * =============================================
     */
    public function index(Request $request){

        return view('admin.pages.dashboard.index', [
            'user' => $request->user(),
        ]);
    }
}
