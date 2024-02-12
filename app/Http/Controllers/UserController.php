<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserDetailRequest;
use App\Http\Requests\UserListRequest;
use App\Models\User;
use App\Services\RoleMasterService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $userService;
    private $roleMasterService;

    public function __construct(UserService $userService, RoleMasterService $roleMasterService)
    {
        $this->userService = $userService;
        $this->roleMasterService = $roleMasterService;
    }

    //SHOWING LIST OF USERS
    public function index(UserListRequest $request)
    {
        //RETRIEVE THE PARAMS
        $sortField = $request->input('sort_field', 'id');
        $sortOrder = $request->input('sort_order', 'asc');
        $keyword = $request->input('keyword');
        $perPage = !is_null($request->input('per_page')) ? $request->input('per_page') : config('constant.CRUD.PER_PAGE');
        $page = !is_null($request->input('page')) ? $request->input('page') : config('constant.CRUD.PAGE');

        //RETRIEVE THE DATA
        $users = $this->userService->listAllUser($perPage, $sortField, $sortOrder, $keyword);

        //BREAD CRUMBS
        $breadcrumbs = [
            'Admin'             => route('admin.user.index'), // Replace 'admin.dashboard' with your actual admin route
            'User Management'   => route('admin.user.index'), // Replace 'user.index' with your actual user index route
            'Detail'            => null, // Replace null with your actual detail URL if available
        ];

        //DISPLAY THE VIEW
        return view('admin.pages.user.index', compact('users', 'breadcrumbs', 'sortField', 'sortOrder', 'perPage', 'page', 'keyword'));
    }

    /**
     * ===========================================
     * ADD NEW USER FUNCTIONALY HERE
     * ===========================================
     */
    // DISPLAY THE ADD NEW USER FORM
    public function create(Request $request)
    {
         //BREAD CRUMBS
         $breadcrumbs = [
            'Admin'             => route('admin.user.index'), // Replace 'admin.dashboard' with your actual admin route
            'User Management'   => route('admin.user.index'), // Replace 'user.index' with your actual user index route
            'Add'            => null, // Replace null with your actual detail URL if available
        ];

        //GET LIST OF AVAILABLE ROLES
        $roles = $this->roleMasterService->getAllRoles();

        return view('admin.pages.user.add', compact('breadcrumbs', 'roles'));
    }

    // PROCESS THE REQUEST
    public function store(UserAddRequest $request){
        // Validation passed, create and store the user
        $result = $this->userService->addNewUser($request);
        if(!is_null($result)){
            $alert = [
                "type" => "success",
                "message" => "data ".$result->name." berhasil dimasukkan"
            ];
        }
        else{
            $alert = [
                "type" => "danger",
                "message" => "data ".$request->name." gagal ditambahkan"
            ];
        }

        // Redirect or do something else after storing the user
        //RETRIEVE THE DATA


        //BREAD CRUMBS
        $breadcrumbs = [
            'Admin'             => route('admin.user.index'), // Replace 'admin.dashboard' with your actual admin route
            'User Management'   => route('admin.user.index'), // Replace 'user.index' with your actual user index route
            'Detail'            => null, // Replace null with your actual detail URL if available
        ];

        $sortField = $request->input('sort_field', 'id');
        $sortOrder = $request->input('sort_order', 'asc');
        $perPage =  config('constant.CRUD.PER_PAGE');
        $page =  config('constant.CRUD.PAGE');
        $keyword = '';

        //RETRIEVE THE DATA
        $users = $this->userService->listAllUser($perPage, $sortField, $sortOrder, $keyword);

        //DISPLAY THE VIEW
        return view('admin.pages.user.index', compact('users', 'breadcrumbs', 'perPage', 'sortField', 'sortOrder', 'keyword', 'page', 'alert'));
    }



    public function detail(Request $request)
    {
        $data = $this->userService->getUserDetail($request->id);

        //BREAD CRUMBS
         $breadcrumbs = [
            'Admin'             => route('admin.user.index'), // Replace 'admin.dashboard' with your actual admin route
            'User Management'   => route('admin.user.index'), // Replace 'user.index' with your actual user index route
            'Detail'            => null, // Replace null with your actual detail URL if available
        ];

        return view('admin.pages.user.detail', compact('breadcrumbs', 'data'));
    }




    public function deleteView(UserListRequest $request)
    {
        $userId = $request->id;


        $data = $this->userService->getUserDetail($userId);

         //BREAD CRUMBS
         $breadcrumbs = [
            'Admin'             => route('admin.user.index'), // Replace 'admin.dashboard' with your actual admin route
            'User Management'   => route('admin.user.index'), // Replace 'user.index' with your actual user index route
            'Detail'            => null, // Replace null with your actual detail URL if available
        ];

        return view('admin.pages.user.detail', compact('breadcrumbs', 'data'));
    }


    public function userDemoPage(Request $request)
    {
        return view('admin.pages.user.useronlypage', [
            'message' => "Hello User, Thanks for using our products",
        ]);
    }
}
