<?php

namespace App\Http\Controllers\Saas;

use App\Helpers\AlertHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Saas\SubscriptionUserAddRequest;
use App\Http\Requests\Saas\SubscriptionUserEditRequest;
use App\Http\Requests\Saas\SubscriptionUserListRequest;
use App\Http\Requests\Saas\SubscriptionUserSuspendRequest;
use App\Services\Saas\SubscriptionUserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class SubscriptionUserController extends Controller
{
    private $subscriptionUserService;
    private $mainBreadcrumbs;

    public function __construct(SubscriptionUserService $subscriptionUserService)
    {
        $this->subscriptionUserService = $subscriptionUserService;

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
        $sortField = session()->get('sort_field', $request->input('sort_field', 'expired_date'));
        $sortOrder = session()->get('sort_order', $request->input('sort_order', 'desc'));

        $perPage = $request->input('per_page', config('constant.CRUD.PER_PAGE'));
        $page = $request->input('page', config('constant.CRUD.PAGE'));
        $keyword = $request->input('keyword');

        $subscriptions = $this->subscriptionUserService->listAllSubscription($perPage, $sortField, $sortOrder, $keyword);

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['List' => null]);

        $alerts = AlertHelper::getAlerts();

        return view('admin.saas.subscriptionuser.index', compact('subscriptions', 'breadcrumbs', 'sortField', 'sortOrder', 'perPage', 'page', 'keyword', 'alerts'));
    }

    /**
     * =============================================
     *      see the detail of single Subscription
     * =============================================
     */
    public function detail(Request $request)
    {
        $data = $this->subscriptionUserService->getSubscriptionDetail($request->id);

        // dd($data);
        if($data){
            $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Detail' => null]);

            return view('admin.saas.subscriptionuser.detail', compact('breadcrumbs', 'data'));
        }
        else{
            $alert = AlertHelper::createAlert('danger', 'Error : Cannot View SubscriptionDetail, Oops! no such data with that ID : ' . $request->id);

            return redirect()->route('subscription.user.index')->with('alerts', [$alert]);
        }

    }

    /**
     * =============================================
     *      see the detail of single Subscription
     * =============================================
     */
    public function suspend($id, $suspendAction = 1)
    {
        $action = $suspendAction == 1 ? "suspend" : "unsuspend";
        $subscriptionData = $this->subscriptionUserService->getSubscriptionDetail($id);
        $userEmail =  $subscriptionData ->user->email;
        $userPackage =  $subscriptionData ->package->package_name;
        try{
            $data = $this->subscriptionUserService->suspendUnsuspend($id, $suspendAction);
            if(!$data){
                throw new Exception("failed to ".$action." data, returned data is null / false from repository ");
            }
            $alert = AlertHelper::createAlert('success', 'Success '.$action.' data with ID : ' . $id ." (".$userEmail." - ".$userPackage.")");
        }
        catch(Exception $e){
            Log::error("Error suspend / unsuspend caused by ", [
                "subscriptionId"    => $id,
                "cause" => $e->getMessage()
            ]);
            $alert = AlertHelper::createAlert('danger', 'Error : Failed to '.$action.' data with ID : ' . $id." (".$userEmail." - ".$userPackage.")");
        }

        return redirect()->route('subscription.user.index')->with([
            'alerts' => [$alert],
            'sort_field' => 'subscription_user.updated_at',
            'sort_order' => 'desc'
        ]);
    }

    public function unsuspend($id){
        return $this->suspend($id, 2);
    }


    /**
     * =============================================
     *      display "add new package" pages
     * =============================================
     */
    public function create(Request $request)
    {

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Add' => null]);

        return view('admin.saas.subscriptionuser.add', compact('breadcrumbs'));
    }

    /**
     * =============================================
     *      proses "add new package" from previous form
     * =============================================
     */
    public function store(SubscriptionUserAddRequest $request)
    {
        $validatedData = $request->validated();

        // dd($validatedData);

        $result = $this->subscriptionUserService->addNewPackage($validatedData);

        $alert = $result
            ? AlertHelper::createAlert('success', 'Data ' . $result->package_name . ' successfully added')
            : AlertHelper::createAlert('danger', 'Data ' . $result->package_name . ' failed to be added');

        return redirect()->route('subscription.user.index')->with([
            'alerts'        => [$alert],
            'sort_order'    => 'desc'
        ]);
    }

    /**
     * =============================================
     *     display "edit packages" pages
     * =============================================
     */
    public function edit(Request $request, $id)
    {
        $package = $this->subscriptionUserService->getPackageDetail($id);

        if ($package) {
            $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Edit' => null]);

            return view('admin.saas.subscriptionuser.edit', compact('breadcrumbs', 'package'));
        } else {
            $alert = AlertHelper::createAlert('danger', 'Error : Cannot edit, Oops! no such data with that ID : ' . $request->id);

            return redirect()->route('subscription.user.index')->with('alerts', [$alert]);
        }
    }

    /**
     * =============================================
     *      process "edit package" from previous form
     * =============================================
     */
    public function update(SubscriptionUserEditRequest $request, $id)
    {
        $result = $this->subscriptionUserService->updatePackage($request->validated(), $id);


        $alert = $result
            ? AlertHelper::createAlert('success', 'Package ' . $result->alias . ' successfully updated')
            : AlertHelper::createAlert('danger', 'Package ' . $request->alias . ' failed to be updated');

        return redirect()->route('subscription.user.index')->with([
            'alerts' => [$alert],
            'sort_field' => 'updated_at',
            'sort_order' => 'desc'
        ]);
    }

    /**
     * =============================================
     *    show delete confirmation for package
     *    while showing the details to make sure
     *    it is correct data which they want to delete
     * =============================================
     */
    public function deleteConfirm(SubscriptionUserListRequest $request)
    {
        $isDeleteable = $this->subscriptionUserService->isDeleteable($request->id);
        $data = $this->subscriptionUserService->getPackageDetail($request->id);
        if ($data) {
            $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Delete' => null]);
            return view('admin.saas.subscriptionuser.delete-confirm', compact('breadcrumbs', 'data', 'isDeleteable'));
        } else {
            $alert = AlertHelper::createAlert('danger', 'Error : Cannot delete, Oops! no such data with that ID : ' . $request->id);

            return redirect()->route('subscription.user.index')->with('alerts', [$alert]);
        }
    }

    /**
     * =============================================
     *      process delete data
     * =============================================
     */
    public function destroy(SubscriptionUserListRequest $request)
    {
        $package = $this->subscriptionUserService->getPackageDetail($request->id);

        if (!is_null($package)) {
            $result = $this->subscriptionUserService->deletePackage($request->id);
        } else {
            $result = false;
        }

        $alert = $result
            ? AlertHelper::createAlert('success', 'Data ' . $package->alias . ' successfully deleted')
            : AlertHelper::createAlert('danger', 'Oops! failed to be deleted');

        return redirect()->route('subscription.user.index')->with('alerts', [$alert]);
    }
}
