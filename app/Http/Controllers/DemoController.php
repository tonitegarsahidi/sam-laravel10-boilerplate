<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{

    private $mainBreadcrumbs;

    public function __construct()
    {
        $this->mainBreadcrumbs = [
            'Demo' => null,
            'Print Service' => route('demo.print'),
        ];

    }

    /**
     * =============================================
     *      if you access /demo it will simply text
     * nothing fancy, but you can use it as "health check"
     * to make sure that your apps is actually running
     * =============================================
     */
    public function index(){
        return "Hello Demo!";
    }

    /**
     * =============================================
     *      show demo of print pages
     * =============================================
     */
    public function print(Request $request){

        return view('admin.pages.demo.print', [
            'data' => $request->user(),
            'breadcrumbs' => $this->mainBreadcrumbs
        ]);

    }
}
