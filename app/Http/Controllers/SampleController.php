<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleController extends Controller
{

    private $mainBreadcrumbs;

    public function __construct()
    {

        // Store common breadcrumbs in the constructor
        $this->mainBreadcrumbs = [
            'Admin' => route('admin.user.index'),
            'Sample UI' => route('admin.user.index'),
        ];
    }


    public function tablePage(Request $request){

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Table' => null]);

        return view('admin.pages.sample.table', compact('breadcrumbs'));

    }

    public function formPage1(Request $request){

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Form 1' => null]);

        return view('admin.pages.sample.form1', compact('breadcrumbs'));

    }

    public function formPage2(Request $request){

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Form 2' => null]);

        return view('admin.pages.sample.form2', compact('breadcrumbs'));

    }


    public function blank(Request $request){

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Blank' => null]);

        return view('admin.pages.sample.blank', compact('breadcrumbs'));

    }



    public function textDivider(Request $request){

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Text Divider' => null]);

        return view('admin.pages.sample.textdivider', compact('breadcrumbs'));

    }

    public function cards(Request $request){

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Cards' => null]);

        return view('admin.pages.sample.cards', compact('breadcrumbs'));

    }

}
