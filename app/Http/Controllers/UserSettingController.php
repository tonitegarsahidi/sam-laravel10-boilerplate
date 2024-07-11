<?php
namespace App\Http\Controllers;

use App\Http\Requests\User\UserChangePasswordRequest;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserDetailRequest;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserListRequest;
use App\Models\User;
use App\Services\RoleMasterService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserSettingController extends Controller
{
    private $userService;
    private $roleMasterService;

    public function __construct(UserService $userService, RoleMasterService $roleMasterService)
    {
        $this->userService = $userService;
        $this->roleMasterService = $roleMasterService;
    }


    public function index()
    {
        $breadcrumbs = [
            'User Setting' => route('user.setting.index'),
        ];

        return view('admin.pages.setting.index', compact('breadcrumbs'));
    }

    public function changePasswordPage()
    {

        $breadcrumbs = [
            'User Setting' => route('user.setting.main'),
            'Change Password' => null,
        ];

        return view('admin.pages.setting.change-password', compact('breadcrumbs'));
    }

    public function doChangePassword(UserChangePasswordRequest $request)
    {
        $breadcrumbs = [
            'Admin' => route('admin.user.index'),
            'User Management' => route('admin.user.index'),
            'Add' => null,
        ];

        $roles = $this->roleMasterService->getAllRoles();

        return view('admin.pages.user.add', compact('breadcrumbs', 'roles'));
    }

    public function store(UserAddRequest $request)
    {
        $result = $this->userService->addNewUser($request);

        $alert = $result ? ['type' => 'success', 'message' => 'Data ' . $result->name . ' berhasil dimasukkan'] :
                           ['type' => 'danger', 'message' => 'Data ' . $request->name . ' gagal ditambahkan'];

        return redirect()->route('admin.user.index')->with('alert', $alert);
    }

    public function detail(Request $request)
    {
        $data = $this->userService->getUserDetail($request->id);

        $breadcrumbs = [
            'Admin' => route('admin.user.index'),
            'User Management' => route('admin.user.index'),
            'Detail' => null,
        ];

        return view('admin.pages.user.detail', compact('breadcrumbs', 'data'));
    }

    public function edit(Request $request, $id)
    {
        $user = $this->userService->getUserDetail($id);
        $user->load('roles');
        $roles = $this->roleMasterService->getAllRoles();

        $breadcrumbs = [
            'Admin' => route('admin.user.index'),
            'User Management' => route('admin.user.index'),
            'Edit' => null,
        ];

        return view('admin.pages.user.edit', compact('breadcrumbs', 'user', 'roles'));
    }

    public function update(UserEditRequest $request, $id)
    {
        $result = $this->userService->updateUser($request, $id);

        $alert = $result ? ['type' => 'success', 'message' => 'Data user ' . $result->name . ' berhasil diperbarui'] :
                           ['type' => 'danger', 'message' => 'Data user ' . $request->name . ' gagal diperbarui'];

        return redirect()->route('admin.user.index')->with('alert', $alert);
    }

    public function deleteConfirm(UserListRequest $request)
    {
        $data = $this->userService->getUserDetail($request->id);

        $breadcrumbs = [
            'Admin' => route('admin.user.index'),
            'User Management' => route('admin.user.index'),
            'Delete' => null,
        ];

        return view('admin.pages.user.delete-confirm', compact('breadcrumbs', 'data'));
    }

    public function destroy(UserListRequest $request)
    {
        $user = $this->userService->getUserDetail($request->id);
        $result = $this->userService->deleteUser($request->id);

        $alert = $result ? ['type' => 'success', 'message' => 'Data user ' . $user->name . ' berhasil dihapus'] :
                           ['type' => 'danger', 'message' => 'Data user ' . $user->name . ' gagal dihapus'];

        return $this->index($request)->with('alert', $alert);
    }

    public function userDemoPage(Request $request)
    {
        return view('admin.pages.user.useronlypage', ['message' => 'Hello User, Thanks for using our products']);
    }
}
