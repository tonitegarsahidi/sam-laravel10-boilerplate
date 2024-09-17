<?php
namespace App\Http\Controllers;

use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserDetailRequest;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserListRequest;
use App\Models\User;
use App\Services\RoleMasterService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Helpers\AlertHelper;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    private $userService;
    private $roleMasterService;
    private $mainBreadcrumbs;

    public function __construct(UserService $userService, RoleMasterService $roleMasterService)
    {
        $this->userService = $userService;
        $this->roleMasterService = $roleMasterService;

        // Store common breadcrumbs in the constructor
        $this->mainBreadcrumbs = [
            'Admin' => route('admin.user.index'),
            'User Management' => route('admin.user.index'),
        ];
    }

    public function index(UserListRequest $request)
    {
        $sortField = session()->get('sort_field', $request->input('sort_field', 'id'));
        $sortOrder = session()->get('sort_order', $request->input('sort_order', 'asc'));
        $perPage = $request->input('per_page', config('constant.CRUD.PER_PAGE'));
        $page = $request->input('page', config('constant.CRUD.PAGE'));
        $keyword = $request->input('keyword');

        $users = $this->userService->listAllUser($perPage, $sortField, $sortOrder, $keyword);

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['List' => null]);

        $alerts = AlertHelper::getAlerts();


        return view('admin.pages.user.index', compact('users', 'breadcrumbs', 'sortField', 'sortOrder', 'perPage', 'page', 'keyword', 'alerts'));
    }

    public function create(Request $request)
    {
        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Add' => null]);

        $roles = $this->roleMasterService->getAllRoles();

        return view('admin.pages.user.add', compact('breadcrumbs', 'roles'));
    }

    public function store(UserAddRequest $request)
    {
        $result = $this->userService->addNewUser($request);

        $alert = $result
        ? AlertHelper::createAlert('success', 'Data ' . $result->name . ' berhasil dimasukkan')
        : AlertHelper::createAlert('danger', 'Data ' . $request->name . ' gagal ditambahkan');


        return redirect()->route('admin.user.index')->with(['alerts'        => [$alert],
                                                            'sort_order'    => 'desc']);
                                                            }

    public function detail(Request $request)
    {
        $data = $this->userService->getUserDetail($request->id);

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Detail' => null]);

        return view('admin.pages.user.detail', compact('breadcrumbs', 'data'));
    }

    public function edit(Request $request, $id)
    {
        $user = $this->userService->getUserDetail($id);
        $user->load('roles');
        $roles = $this->roleMasterService->getAllRoles();

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Edit' => null]);

        return view('admin.pages.user.edit', compact('breadcrumbs', 'user', 'roles'));
    }

    public function update(UserEditRequest $request, $id)
    {
        $result = $this->userService->updateUser($request, $id);


        $alert = $result
        ? AlertHelper::createAlert('success', 'Data ' . $result->name . ' berhasil diperbarui')
        : AlertHelper::createAlert('danger', 'Data ' . $request->name . ' gagal diperbarui');

        return redirect()->route('admin.user.index')->with(['alerts' => [$alert],
                                                            'sort_field'=> 'updated_at',
                                                            'sort_order'=> 'desc'
                                                            ]);
    }

    public function deleteConfirm(UserListRequest $request)
    {
        $data = $this->userService->getUserDetail($request->id);

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Delete' => null]);

        return view('admin.pages.user.delete-confirm', compact('breadcrumbs', 'data'));
    }

    public function destroy(UserListRequest $request)
    {
        $user = $this->userService->getUserDetail($request->id);
        $result = $this->userService->deleteUser($request->id);


        $alert = $result
        ? AlertHelper::createAlert('success', 'Data ' . $user->name . ' berhasil dihapus')
        : AlertHelper::createAlert('danger', 'Oops! Data ' . $user->name . ' gagal dihapus');

        return redirect()->route('admin.user.index')->with('alerts', [$alert]);
    }

    public function userDemoPage(Request $request)
    {
        return view('admin.pages.user.useronlypage', ['message' => 'Hello User, Thanks for using our products']);
    }
}
