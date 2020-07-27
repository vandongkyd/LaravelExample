<?php


namespace App\Http\Controllers\Shop;


use App\ServiceIml\Shop\InfoService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\Routing\Annotation\Route;

class InfoController extends CommonController
{

    /**
     * @var InfoService
     */
    private $infoService;

    /**
     * InfoController constructor.
     * @param InfoService $infoService
     */
    public function __construct(InfoService $infoService)
    {
        $this->infoService = $infoService;
    }

    /**
     * @Route("change-password/{id}")
     * @param $id
     * @return Factory|View
     */
    public function ChangePasswordById($id){
        $customerId = str_replace(self::COMMON_TEXT,"",base64_decode($id));
        return view("shop.information.change_password",[
            "id" => $id
        ]);
    }

    /**
     * @Route("change-password/{id}")
     * @Method POST
     * @param Request $request
     * @param $id
     * @return void
     */
    public function doChangePasswordById(Request $request, $id){
        try {
            $customerId = str_replace(self::COMMON_TEXT, "", base64_decode($id));
            $request["id"] = $customerId;
            $customer = $this->infoService->changePassword($request);
            if ($customer["status"]){
                $msg = "Cập Nhật Mật Khẩu Thành Công!";
                return redirect()->route("loginAdmin")->with(['status' => "success", 'message'=> $msg]);
            }
            $msg = "Cập Nhật Mật Khẩu Thất Bại!";
            return redirect()->back()->with(['status' => "error", 'message'=> $msg])->withErrors($customer['validate'])->withInput();

        }catch (\Exception $ex){
            Log::debug($ex->getMessage());
            return \view("");
        }
    }
}
