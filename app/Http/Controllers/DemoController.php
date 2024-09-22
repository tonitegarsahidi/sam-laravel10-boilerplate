<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{

    private $mainBreadcrumbs;

    public function __construct()
    {    // Store common breadcrumbs in the constructor
        $this->mainBreadcrumbs = [
            'Demo' => route('demo'),
            'Print Service' => route('demo.print'),
        ];

    }

    public function index(){
        return "Hello Demo!";
    }

    public function print(Request $request){

        return view('admin.pages.demo.print', [
            'data' => $request->user(),
            'breadcrumbs' => $this->mainBreadcrumbs
        ]);

    }
}
