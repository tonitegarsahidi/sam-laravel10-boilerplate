<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleController extends Controller
{

    public function chartPages(Request $request){

        return view('admin.pages.sample.chart', [
            'user' => $request->user(),
        ]);

    }

    public function tablePages(Request $request){

        return view('admin.pages.sample.table', [
            'user' => $request->user(),
        ]);

    }

    public function documentationPages(Request $request){

        return view('admin.pages.sample.documentation', [
            'user' => $request->user(),
        ]);

    }

    public function formPages(Request $request){

        return view('admin.pages.sample.form', [
            'user' => $request->user(),
        ]);

    }

    public function uiButtonPages(Request $request){

        return view('admin.pages.sample.uiButton', [
            'user' => $request->user(),
        ]);

    }

    public function uiTypographyPages(Request $request){

        return view('admin.pages.sample.uiTypography', [
            'user' => $request->user(),
        ]);

    }
}
