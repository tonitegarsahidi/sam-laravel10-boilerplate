<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $userService;

    public function __construct(UserService $userService){

        $this->userService = $userService;

    }

    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $users = $this->userService->listAllUser($perPage);

        $breadcrumb = [
            "level1text"   => "Admin",
            "level2text"   => "User Management",
        ];

        return view('admin.pages.user.index', compact('users', 'breadcrumb'));
    }

    public function userDemoPage(Request $request){
        return view('admin.pages.user.useronlypage', [
            'message' => "Hello User, Thanks for using our products",
        ]);

    }
}
