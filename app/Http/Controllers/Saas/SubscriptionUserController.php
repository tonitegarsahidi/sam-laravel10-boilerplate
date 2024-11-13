<?php

namespace App\Http\Controllers\Saas;

use App\Helpers\AlertHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Saas\SubscriptionUserAddRequest;
use App\Http\Requests\Saas\SubscriptionUserFindUserRequest;
use App\Http\Requests\Saas\SubscriptionUserListRequest;
use App\Services\Saas\SubscriptionMasterService;
use App\Services\Saas\SubscriptionUserService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class SubscriptionUserController extends Controller
{
    private $subscriptionUserService;
    private $subscriptionMasterService;
    private $mainBreadcrumbs;
    private $userService;

    public function __construct(
        SubscriptionUserService $subscriptionUserService,
        SubscriptionMasterService $subscriptionMasterService,
        UserService $userService
    ) {
        $this->subscriptionMasterService = $subscriptionMasterService;
        $this->subscriptionUserService = $subscriptionUserService;
        $this->userService = $userService;

        // Store common breadcrumbs in the constructor
        $this->mainBreadcrumbs = [
            'Subscription' => route('subscription.user.index'),
            'User' => route('subscription.user.index'),
        ];
    }

    // ============================ START OF ULTIMATE CRUD FUNCTIONALITY ===============================
    /**
     * =============================================
     *      list all search and filter/sort things
     * =============================================
     */
    public function index(SubscriptionUserListRequest $request)
    {
        $sortField = session()->get('sort_field', $request->input('sort_field', 'subscription_user.updated_at'));
        $sortOrder = session()->get('sort_order', $request->input('sort_order', 'desc'));

        $perPage = $request->input('per_page', config('constant.CRUD.PER_PAGE'));
        $page = $request->input('page', config('constant.CRUD.PAGE'));
        $keyword = $request->input('keyword');
        $userId = $request->input('userId');

        $subscriptions = $this->subscriptionUserService->listAllSubscription($perPage, $sortField, $sortOrder, $keyword, $userId);

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['List' => null]);

        $alerts = AlertHelper::getAlerts();

        return view('admin.saas.subscriptionuser.index', compact('subscriptions', 'userId', 'breadcrumbs', 'sortField', 'sortOrder', 'perPage', 'page', 'keyword', 'alerts'));
    }

    /**
     * =============================================
     *      see the detail of single Subscription
     * =============================================
     */
    public function detail(Request $request)
    {
        $data = $this->subscriptionUserService->getSubscriptionDetail($request->id);
        $alerts = AlertHelper::getAlerts();

        // dd($data);
        if ($data) {
            $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Detail' => null]);

            return view('admin.saas.subscriptionuser.detail', compact('breadcrumbs', 'data', 'alerts'));
        } else {
            $alert = AlertHelper::createAlert('danger', 'Error : Cannot View SubscriptionDetail, Oops! no such data with that ID : ' . $request->id);

            return redirect()->route('subscription.user.index')->with('alerts', [$alert]);
        }
    }

    /**
     * =============================================
     *      suspend and unsuspend
     * =============================================
     */
    public function suspend($subscriptionId, $suspendAction = 1)
    {
        $action = $suspendAction == 1 ? "suspend" : "unsuspend";
        $subscriptionData = $this->subscriptionUserService->getSubscriptionDetail($subscriptionId);
        $userEmail =  $subscriptionData->user->email;
        $userPackage =  $subscriptionData->package->package_name;
        try {
            $data = $this->subscriptionUserService->suspendUnsuspend($subscriptionId, $suspendAction, Auth::user()->id);
            if (!$data) {
                throw new Exception("failed to " . $action . " data, returned data is null / false from repository ");
            }
            $alert = AlertHelper::createAlert('success', 'Success ' . $action . ' data with ID : ' . $subscriptionId . " (" . $userEmail . " - " . $userPackage . ")");
        } catch (Exception $e) {
            Log::error("Error suspend / unsuspend caused by ", [
                "subscriptionId"    => $subscriptionId,
                "cause" => $e->getMessage()
            ]);
            $alert = AlertHelper::createAlert('danger', 'Error : Failed to ' . $action . ' data with ID : ' . $subscriptionId . " (" . $userEmail . " - " . $userPackage . ")");
        }

        return redirect()->back()->with([
            'alerts' => [$alert],
            'sort_field' => 'subscription_user.updated_at',
            'sort_order' => 'desc'
        ]);
    }

    public function unsuspend($id)
    {
        return $this->suspend($id, 2);
    }

    /**
     * =============================================
     *      unsubscribe
     * =============================================
     */
    public function unsubscribe($subscriptionId)
    {

        $subscriptionData = $this->subscriptionUserService->getSubscriptionDetail($subscriptionId);
        $userEmail =  $subscriptionData->user->email;
        $userPackage =  $subscriptionData->package->package_name;
        try {
            $data = $this->subscriptionUserService->unsubscribe($subscriptionId, Auth::user()->id);
            if (!$data) {
                throw new Exception("failed to Unsubscribe, returned data is null / false from repository ");
            }
            $alert = AlertHelper::createAlert('success', 'Success unsubscribe data with ID : ' . $subscriptionId . " (" . $userEmail . " - " . $userPackage . ")");
        } catch (Exception $e) {
            Log::error("Error unsubscribe caused by ", [
                "subscriptionId"    => $subscriptionId,
                "cause" => $e->getMessage()
            ]);
            $alert = AlertHelper::createAlert('danger', 'Error : Failed to unsubscribe data with ID : ' . $subscriptionId . " (" . $userEmail . " - " . $userPackage . ")");
        }

        return redirect()->back()->with([
            'alerts' => [$alert],
            'sort_field' => 'subscription_user.updated_at',
            'sort_order' => 'desc'
        ]);
    }

    /**
     * =============================================
     *      process Subscribe / Unsubscribe
     * =============================================
     */
    public function resubscribe($subscriptionId)
    {

        $subscriptionData = $this->subscriptionUserService->getSubscriptionDetail($subscriptionId);
        $userEmail =  $subscriptionData->user->email;
        $userPackage =  $subscriptionData->package->package_name;
        try {
            $data = $this->subscriptionUserService->subscribe($subscriptionData->user->id, $subscriptionData->package->id, "manual", false, Auth::user()->id);
            if (!$data) {
                throw new Exception("failed to Resubscribe, returned data is null / false from repository ");
            }
            $alert = AlertHelper::createAlert('success', 'Success ReSubscribe data with ID : ' . $subscriptionId . " (" . $userEmail . " - " . $userPackage . ")");
        } catch (Exception $e) {
            Log::error("Error unsubscribe caused by ", [
                "subscriptionId"    => $subscriptionId,
                "cause" => $e->getMessage()
            ]);
            $alert = AlertHelper::createAlert('danger', 'Error : Failed to resubscribe data with ID : ' . $subscriptionId . " (" . $userEmail . " - " . $userPackage . ")");
        }

        return redirect()->back()->with([
            'alerts' => [$alert],
            'sort_field' => 'subscription_user.updated_at',
            'sort_order' => 'desc'
        ]);
    }

    /**
     * =============================================
     *      process create subscription
     * =============================================
     */
    public function create(SubscriptionUserFindUserRequest $request)
    {

        $sortField = session()->get('sort_field', $request->input('sort_field', 'id'));
        $sortOrder = session()->get('sort_order', $request->input('sort_order', 'asc'));

        $perPage = $request->input('per_page', config('constant.CRUD.PER_PAGE'));
        $page = $request->input('page', config('constant.CRUD.PAGE'));
        $keyword = $request->input('keyword');
        $alerts = AlertHelper::getAlerts();

        // JIKA USER SUDAH DISET / BELUM
        if (isset($request->user)) {
            $userIsSet = true;
            $findUsers = null;
            //find users first
            $userFound = $this->userService->getUserDetail($request->user);

            // if user is not found or invalid users
            if (!$userFound) {
                $alert =  AlertHelper::createAlert('danger', 'Error : Invalid user Id : ' . $request->user);
                $userFound = null;
                return redirect()->route('subscription.user.index')->with([
                    'alerts' => [$alert]
                ]);
            }

            if (!$userFound->is_active) {
                $alerts = [...$alerts, AlertHelper::createAlert('danger', 'This user is inactive state, you cannot subscribe this')];
            }

            // IF package params is set
            $selectedPackage = $request->package;

            $package = $this->subscriptionMasterService->listAllPackage(100000);

            $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Add (Step 2/2 : Choose Package)' => null]);


            return view('admin.saas.subscriptionuser.add', compact('userIsSet','selectedPackage', 'alerts', 'userFound', 'package', 'breadcrumbs'));
        } else {
            $userFound = null;

            $userIsSet = false;
            $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Add (Step 1/2 : Choose User)' => route('subscription.user.add')]);

            $findUsers = $this->userService->listAllUser($perPage, $sortField, $sortOrder, $keyword);

            $alerts = AlertHelper::getAlerts();

            return view('admin.saas.subscriptionuser.find-user', compact('userIsSet', 'userFound', 'findUsers', 'breadcrumbs', 'sortField', 'sortOrder', 'perPage', 'page', 'keyword'));
        }
    }

    /**
     * =============================================
     *      process store subscription
     * =============================================
     */
    public function store(SubscriptionUserAddRequest $request)
    {
        try {

            $user = $this->userService->getUserDetail($request->user);
            $package = $this->subscriptionMasterService->getPackageDetail($request->package);

            $data = $this->subscriptionUserService->subscribe($user->id, $package->id, "manual", false, Auth::user()->id);
            if (!$data) {
                throw new Exception("failed to Subscribe, returned data is null / false from repository ");
            }

            $alert = AlertHelper::createAlert('success', "Success create subscription data for " . $user->email . " and package " . $package->package_name . ")");
        } catch (Exception $e) {
            Log::error("Error subscribe caused by ", [
                "userId"    => $user->id,
                "package"    => $package->id,
                "cause" => $e->getMessage()
            ]);
            $alert = AlertHelper::createAlert('danger', "Error : Failed to susbcribe data for " . $user->email . " and package " . $package->package_name . ")");
        }

        return redirect()->route('subscription.user.detail', ['id' => $data->id])->with([
            'alerts' => [$alert],
            'sort_field' => 'subscription_user.created_at',
            'sort_order' => 'desc'
        ]);
    }
}
