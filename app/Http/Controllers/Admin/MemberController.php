<?php

namespace App\Http\Controllers\Admin;


use App\ServiceIml\Admin\MemberService;
use App\ServiceIml\Admin\StoreService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\Routing\Annotation\Route;

class MemberController extends CommonController implements CommonAction
{

    /**
     * @var MemberService
     */
    private $memberService;


    /**
     * MemberController constructor.
     * @param MemberService $memberService
     */
    public function __construct(MemberService $memberService)
    {
        $this->middleware("auth:admin");
        $this->memberService = $memberService;
    }

    /**
     * @Route("admins/member/list")
     * @Array list member
     * @return Factory|View
     */
    function index()
    {
        $members = $this->memberService->list();
        return \view("admin.member.index",[
            "members" => $members
        ]);
    }

    /**
     * @Route("admins/member/add")
     * @param Request $request
     * @return Factory|View
     */
    function add(Request $request)
    {
        $roles = $this->getRole();
        return \view("admin.member.add",[
            "roles" => $roles,
        ]);
    }

    /**
     * @Route("admins/member/edit")
     * @param $id
     * @return Factory|View
     */
    function edit($id)
    {
        $roles = $this->getRole();
        $member = $this->memberService->fetchById($id);
        return \view("admin.member.edit",[
            "roles" => $roles,
            "member" => $member
        ]);
    }

    /**
     * @Route("admins/member/add")
     * @Method POST
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    function doAdd(Request $request)
    {
        try {
            $member = $this->memberService->add($request);
            $redirect = $this->FactoryAndMessage($member,"member.list","Member","add");
            return $redirect;
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return view('admin.error.502');
        }
    }

    /**
     * @Route("admins/member/edit")
     * @Method POST
     * @param Request $request
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    function doEdit(Request $request, $id)
    {
        try {
            $member = $this->memberService->edit($request, $id);
            $redirect = $this->FactoryAndMessage($member,"member.list","Member","edit");
            return $redirect;
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return view('admin.error.502');
        }
    }

    /**
     * @Route("admins/member/delete")
     * @Method POST
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    function doDelete(Request $request)
    {
        try {
            $member = $this->memberService->delete($request);
            $redirect = $this->FactoryAndMessage($member,"member.list","Member","delete");
            return $redirect;
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return view('admin.error.502');
        }
    }

    /**
     * @Route("admins/member/reset")
     * @Method POST
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    function doReset(Request $request)
    {
        try {
            $member = $this->memberService->reset($request);
            $redirect = $this->FactoryAndMessage($member,"member.list","Member","reset");
            return $redirect;
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return view('admin.error.502');
        }
    }

    /**
     * @Route("admins/member/lock")
     * @Method POST
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    function doLock(Request $request)
    {
        try {
            $member = $this->memberService->lock($request);
            $redirect = $this->FactoryAndMessage($member,"member.list","Member","lock");
            return $redirect;
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return view('admin.error.502');
        }
    }

    /**
     * @Route("admins/member/unlock")
     * @Method POST
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    function doUnlock(Request $request)
    {
        try {
            $member = $this->memberService->unlock($request);
            $redirect = $this->FactoryAndMessage($member,"member.list","Member","unlock");
            return $redirect;
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return view('admin.error.502');
        }
    }
}
