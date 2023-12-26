<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $userService;

    public function __construct(UserService $userService)
    {

        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $sortField = $request->input('sort_field', 'id');
        $sortOrder = $request->input('sort_order', 'asc');
        $page = $request->input('page', '1');

        $perPage = $request->input('per_page', config('constant.DEFAULT_PAGINATION_PERPAGE'));
        $users = $this->userService->listAllUser($perPage, $sortField, $sortOrder);

        $breadcrumb = [
            "level1text"   => "Admin",
            "level2text"   => "User Management",
        ];

        return view('admin.pages.user.index', compact('users', 'breadcrumb', 'sortField', 'sortOrder', 'perPage', 'page'));
    }

    public function create(Request $request)
    {
        $breadcrumb = [
            "level1text"   => "Admin",
            "level2text"   => "User Management",
            "level3text"   => "Add",
        ];

        dd("hello sam");

        return view('admin.pages.user.add', compact('breadcrumb'));
    }

    public function detail(Request $request)
    {
        $userId = $request->input('id');
        $users = $this->userService->listUserDetail($userId);

        $breadcrumb = [
            "level1text"   => "Admin",
            "level2text"   => "User Management",
            "level3text"   => "Detail",
        ];

        // $userDetail = $this->userService->getUserDetail($request->id);

        return view('admin.pages.user.index', compact('breadcrumb'));
    }

    public function userDemoPage(Request $request)
    {
        return view('admin.pages.user.useronlypage', [
            'message' => "Hello User, Thanks for using our products",
        ]);
    }
}
