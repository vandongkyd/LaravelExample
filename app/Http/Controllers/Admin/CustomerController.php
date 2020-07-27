<?php


namespace App\Http\Controllers\Admin;


use App\ServiceIml\Admin\CustomerService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends CommonController implements CommonAction
{

    /**
     * @var CustomerService
     */
    private $customerService;

    /**
     * CustomerController constructor.
     * @param CustomerService $customerService
     */
    public function __construct(CustomerService $customerService)
    {
        $this->middleware("auth:admin");
        $this->customerService = $customerService;
    }

    /**
     * @Route("admins/customer/list")
     * @Array list customer
     * @return Factory|View
     */
    function index()
    {
        $customers = $this->customerService->list();
        return \view("admin.customer.index",[
            "customers" => $customers
        ]);
    }

    /**
     * @Route("admins/customer/add")
     * @param Request $request
     * @return Factory|View
     */
    function add(Request $request)
    {
        return \view("admin.customer.add");
    }

    /**
     * @Route("admins/customer/edit")
     * @param $id
     * @return Factory|View
     */
    function edit($id)
    {
        $customer = $this->customerService->fetchById($id);
        return \view("admin.customer.edit",[
            "customer" => $customer
        ]);
    }

    /**
     * @Route("admins/customer/add")
     * @Method POST
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    function doAdd(Request $request)
    {
        try {
            $customer = $this->customerService->add($request);
            $redirect = $this->FactoryAndMessage($customer,"customer.list","Customer","add");
            return $redirect;
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return view('admin.error.502');
        }
    }

    /**
     * @Route("admins/customer/edit")
     * @Method POST
     * @param Request $request
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    function doEdit(Request $request, $id)
    {
        try {
            $customer = $this->customerService->edit($request, $id);
            $redirect = $this->FactoryAndMessage($customer,"customer.list","Customer","edit");
            return $redirect;
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return view('admin.error.502');
        }
    }

    /**
     * @Route("admins/customer/delete")
     * @Method POST
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    function doDelete(Request $request)
    {
        try {
            $customer = $this->customerService->delete($request);
            $redirect = $this->FactoryAndMessage($customer,"customer.list","Customer","delete");
            return $redirect;
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return view('admin.error.502');
        }
    }

    /**
     * @Route("admins/customer/reset")
     * @Method POST
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    function doReset(Request $request)
    {
        try {
            $customer = $this->customerService->reset($request);
            $redirect = $this->FactoryAndMessage($customer,"customer.list","Customer","reset");
            return $redirect;
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return view('admin.error.502');
        }
    }

    /**
     * @Route("admins/customer/lock")
     * @Method POST
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    function doLock(Request $request)
    {
        try {
            $customer = $this->customerService->lock($request);
            $redirect = $this->FactoryAndMessage($customer,"customer.list","Customer","lock");
            return $redirect;
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return view('admin.error.502');
        }
    }

    /**
     * @Route("admins/customer/unlock")
     * @Method POST
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    function doUnlock(Request $request)
    {
        try {
            $customer = $this->customerService->unlock($request);
            $redirect = $this->FactoryAndMessage($customer,"customer.list","Customer","unlock");
            return $redirect;
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return view('admin.error.502');
        }
    }
}
