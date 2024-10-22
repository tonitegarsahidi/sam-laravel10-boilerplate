<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


/**
     * ################################################
     *      THIS IS SAMPLE CONTROLLER
     *  mostly used to display UI implementation.
     *  the main UI for SamBoilerplate is from the Sneat Theme,
     *  check or license about them (to remove credit in footer) in their website
     * ################################################
     */
class SampleController extends Controller
{

    private $mainBreadcrumbs;

    /**
     * =============================================
     *      constructor
     * =============================================
     */

    public function __construct()
    {

        // Store common breadcrumbs in the constructor
        $this->mainBreadcrumbs = [
            'Admin' => route('admin.user.index'),
            'Sample UI' => route('admin.user.index'),
        ];
    }

    /**
     * =============================================
     *      show sample page for UI tables
     * =============================================
     */
    public function tablePage(Request $request){

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Table' => null]);

        return view('admin.pages.sample.table', compact('breadcrumbs'));

    }

    /**
     * =============================================
     *  show sample page for UI Form
     * =============================================
     */
    public function formPage1(Request $request){

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Form 1' => null]);

        return view('admin.pages.sample.form1', compact('breadcrumbs'));

    }

    /**
     * =============================================
     * show sample page for UI Form (2nd version)
     * =============================================
     */
    public function formPage2(Request $request){

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Form 2' => null]);

        return view('admin.pages.sample.form2', compact('breadcrumbs'));

    }


    /**
     * =============================================
     *  show sample page for blank pages
     * =============================================
     */
    public function blank(Request $request){

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Blank' => null]);

        return view('admin.pages.sample.blank', compact('breadcrumbs'));

    }

    /**
     * =============================================
     *  show sample page for UI text divider
     * =============================================
     */
    public function textDivider(Request $request){

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Text Divider' => null]);

        return view('admin.pages.sample.textdivider', compact('breadcrumbs'));

    }

    /**
     * =============================================
     *      show sample page for UI cards
     * =============================================
     */
    public function cards(Request $request){

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Cards' => null]);

        return view('admin.pages.sample.cards', compact('breadcrumbs'));

    }

}
