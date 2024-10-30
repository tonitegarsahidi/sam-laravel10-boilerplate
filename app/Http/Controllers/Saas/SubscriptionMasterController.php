<?php

namespace App\Http\Controllers\Saas;

use App\Helpers\AlertHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Saas\SubscriptionMasterAddRequest;
use App\Http\Requests\Saas\SubscriptionMasterEditRequest;
use App\Http\Requests\Saas\SubscriptionMasterListRequest;
use App\Services\Saas\SubscriptionMasterService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SubscriptionMasterController extends Controller
{
    private $subscriptionMasterService;
    private $mainBreadcrumbs;

    public function __construct(SubscriptionMasterService $subscriptionMasterService)
    {
        $this->subscriptionMasterService = $subscriptionMasterService;

        // Store common breadcrumbs in the constructor
        $this->mainBreadcrumbs = [
            'Subscription' => route('subscription.packages.index'),
            'Packages' => route('subscription.packages.index'),
        ];
    }

    // ============================ START OF ULTIMATE CRUD FUNCTIONALITY ===============================



    /**
     * =============================================
     *      list all search and filter/sort things
     * =============================================
     */
    public function index(SubscriptionMasterListRequest $request)
    {
        $sortField = session()->get('sort_field', $request->input('sort_field', 'id'));
        $sortOrder = session()->get('sort_order', $request->input('sort_order', 'asc'));

        $perPage = $request->input('per_page', config('constant.CRUD.PER_PAGE'));
        $page = $request->input('page', config('constant.CRUD.PAGE'));
        $keyword = $request->input('keyword');

        $packages = $this->subscriptionMasterService->listAllPackage($perPage, $sortField, $sortOrder, $keyword);

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['List' => null]);

        $alerts = AlertHelper::getAlerts();

        return view('admin.saas.subscriptionmaster.index', compact('packages', 'breadcrumbs', 'sortField', 'sortOrder', 'perPage', 'page', 'keyword', 'alerts'));
    }

    /**
     * =============================================
     *      display "add new package" pages
     * =============================================
     */
    public function create(Request $request)
    {

        $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Add' => null]);

        return view('admin.saas.subscriptionmaster.add', compact('breadcrumbs'));
    }

    /**
     * =============================================
     *      proses "add new package" from previous form
     * =============================================
     */
    public function store(SubscriptionMasterAddRequest $request)
    {
        $validatedData = $request->validated();

        // dd($validatedData);

        $result = $this->subscriptionMasterService->addNewPackage($validatedData);

        $alert = $result
            ? AlertHelper::createAlert('success', 'Data ' . $result->package_name . ' successfully added')
            : AlertHelper::createAlert('danger', 'Data ' . $result->package_name . ' failed to be added');

        return redirect()->route('subscription.packages.index')->with([
            'alerts'        => [$alert],
            'sort_order'    => 'desc'
        ]);
    }

    /**
     * =============================================
     *      see the detail of single package entity
     * =============================================
     */
    public function detail(Request $request)
    {
        $data = $this->subscriptionMasterService->getPackageDetail($request->id);

        // dd($data);
        if($data){
            $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Detail' => null]);

            return view('admin.saas.subscriptionmaster.detail', compact('breadcrumbs', 'data'));
        }
        else{
            $alert = AlertHelper::createAlert('danger', 'Error : Cannot View Detail, Oops! no such data with that ID : ' . $request->id);

            return redirect()->route('subscription.packages.index')->with('alerts', [$alert]);
        }


    }

    /**
     * =============================================
     *     display "edit packages" pages
     * =============================================
     */
    public function edit(Request $request, $id)
    {
        $package = $this->subscriptionMasterService->getPackageDetail($id);

        if ($package) {
            $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Edit' => null]);

            return view('admin.saas.subscriptionmaster.edit', compact('breadcrumbs', 'package'));
        } else {
            $alert = AlertHelper::createAlert('danger', 'Error : Cannot edit, Oops! no such data with that ID : ' . $request->id);

            return redirect()->route('subscription.packages.index')->with('alerts', [$alert]);
        }
    }

    /**
     * =============================================
     *      process "edit package" from previous form
     * =============================================
     */
    public function update(SubscriptionMasterEditRequest $request, $id)
    {
        $result = $this->subscriptionMasterService->updatePackage($request->validated(), $id);


        $alert = $result
            ? AlertHelper::createAlert('success', 'Package ' . $result->alias . ' successfully updated')
            : AlertHelper::createAlert('danger', 'Package ' . $request->alias . ' failed to be updated');

        return redirect()->route('subscription.packages.index')->with([
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
    public function deleteConfirm(SubscriptionMasterListRequest $request)
    {
        $isDeleteable = $this->subscriptionMasterService->isDeleteable($request->id);
        $data = $this->subscriptionMasterService->getPackageDetail($request->id);
        if ($data) {
            $breadcrumbs = array_merge($this->mainBreadcrumbs, ['Delete' => null]);
            return view('admin.saas.subscriptionmaster.delete-confirm', compact('breadcrumbs', 'data', 'isDeleteable'));
        } else {
            $alert = AlertHelper::createAlert('danger', 'Error : Cannot delete, Oops! no such data with that ID : ' . $request->id);

            return redirect()->route('subscription.packages.index')->with('alerts', [$alert]);
        }
    }

    /**
     * =============================================
     *      process delete data
     * =============================================
     */
    public function destroy(SubscriptionMasterListRequest $request)
    {
        $package = $this->subscriptionMasterService->getPackageDetail($request->id);

        if (!is_null($package)) {
            $result = $this->subscriptionMasterService->deletePackage($request->id);
        } else {
            $result = false;
        }

        $alert = $result
            ? AlertHelper::createAlert('success', 'Data ' . $package->alias . ' successfully deleted')
            : AlertHelper::createAlert('danger', 'Oops! failed to be deleted');

        return redirect()->route('subscription.packages.index')->with('alerts', [$alert]);
    }
}
