<?php


namespace App\Http\Controllers\Admin;


use App\ServiceIml\Admin\SettingService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\Routing\Annotation\Route;

class SettingController extends CommonController
{
    /**
     * @var SettingService
     */
    private $settingService;

    /**
     * SettingController constructor.
     * @param SettingService $settingService
     */
    public function __construct(SettingService $settingService)
    {
        $this->middleware("auth:admin");
        $this->settingService = $settingService;
    }

    /**
     * @Route("admins/setting/profile")
     * @return Factory|View
     */
    public function profile(){
        $account = Auth::guard("admin")->user();
        return view("admin.setting.profile",[
            "account" => $account
        ]);
    }

    /**
     * @Route("admins/setting/change-password")
     * @return Factory|View
     */
    public function changePassword(){
        $account = Auth::guard("admin")->user();
        return \view("admin.setting.change_password",[
            "account" => $account
        ]);
    }

    /**
     * @Route("admins/setting/profile/{id}")
     * @Method POST
     * @param Request $request
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    public function doProfile(Request $request, $id){
        try {
            $account = $this->settingService->profile($request, $id);
            $redirect = $this->FactoryAndMessage($account,"setting.profile","Member","profile");
            return $redirect;
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return view('admin.error.502');
        }
    }


    /**
     * @Route("admins/setting/change-password/{id}")
     * @Method POST
     * @param Request $request
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    public function doChangePassword(Request $request, $id){
        try {
            $account = $this->settingService->changePassword($request, $id);
            $redirect = $this->FactoryAndMessage($account,"setting.changePassword","Member","change");
            return $redirect;
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return view('admin.error.502');
        }
    }
}
