<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperatorController extends Controller
{

    /**
     * =============================================
     *      Handle sample pages
     *      which can only be accessed
     *      by this role operator
     * =============================================
     */
    public function index(Request $request){
        return view('admin.pages.operator.index', [
            'message' => "Hello Operator, you are a good operator, thank you",
        ]);

    }
}
