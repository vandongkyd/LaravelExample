<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Model\Customer;
use App\Model\Payment;
use App\Model\Product;
use App\Model\ProductImage;
use App\Model\Role;
use App\Model\Status;
use App\Model\Store;
use DOMDocument;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommonController extends Controller
{
    const ADD = 'add';
    const EDIT = 'edit';
    const RESET = 'reset';
    const LOCK = 'lock';
    const UNLOCK = 'unlock';
    const CHANGE = 'change';
    const PROFILE = 'profile';
    const DELETE = 1;
    const DEl_FLG = 0;

    /**
     * @param $object
     * @param $route
     * @param $model
     * @param $tyle
     * @return RedirectResponse
     */
    public function FactoryAndMessage($object, $route, $model, $tyle){
        $action = null;
        if($tyle == self::ADD) $action = "Thêm";
        elseif ($tyle == self::EDIT) $action = "Cập Nhật";
        elseif ($tyle == self::RESET) $action = "Đặt Lại";
        elseif ($tyle == self::LOCK) $action = "Khóa";
        elseif ($tyle == self::UNLOCK) $action = "Mở Khóa";
        elseif ($tyle == self::CHANGE) $action = "Thay Đổi Mật Khẩu";
        elseif ($tyle == self::PROFILE) $action = "Thay Đổi Thông Tin";
        else $action = "Xóa";

        if($object['status']){
            $msg =  $action. " " .$model. " " . "Thành Công!";
            return redirect()->route($route)->with(['status' => "success", 'message'=> $msg]);
        }else{
            $msg = $action. " " .$model. " " . "Thất Bại!";
            return redirect()->back()->with(['status' => "error", 'message'=> $msg])->withErrors($object['validate'])->withInput();
        }
    }

    /**
     * @param $description
     * @return string
     */
    public function AddImageNote($description){
        $dom = new DOMDocument();
        $dom->loadHtml('<?xml encoding="utf-8" ?>'.$description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $tagImg = $dom->getElementsByTagName('img');
        foreach ($tagImg as $img) {
            $data = $img->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);
            $image_name = uniqid() . '_' . time() . '.png';
            $path = public_path('save_image') . '/' . $image_name;
            file_put_contents($path, $data);
            $img->removeAttribute('src');
            $img->setAttribute('src', url('/save_image/') . '/' . $image_name);
        }

        return $dom->saveHTML();
    }

    /**
     * @param $description
     * @return string
     */
    public function EditImageNote($description){
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml('<?xml encoding="utf-8" ?>'.$description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $tagImg = $dom->getElementsByTagName('img');
        foreach ($tagImg as $img) {
            $data = $img->getAttribute('src');
            if (!strstr($data, url('/save_image/'))) {
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $data = base64_decode($data);
                $image_name = rand() . time() . '.png';
                $path = public_path('save_image') . '/' . $image_name;
                file_put_contents($path, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', url('/save_image/') . '/' . $image_name);
            }
        }
        return $dom->saveHTML();
    }

    /**
     * @return Role[]|Collection
     */
    public function getRole(){
        return Role::all();
    }

    /**
     * @return mixed
     */
    public function getCustomers(){
        return Customer::where("status", "=", Customer::ACTIVE)->where("del_flg", "=", Customer::DEl_FLG)->get();
    }

    public function getProducts(){
        return Product::where("product_status", "=", Product::USE)->where("del_flg", "=", Product::DEl_FLG)->get();
    }

    /**
     * @return Status[]|Collection
     */
    public function getStatus(){
        return Status::all();
    }


    /**
     * @Route("admin/common/remove-image")
     * @param Request $request
     */
    public function doRemoveImage(Request $request){
        $fileName = $request->get('file');
        if(isset($fileName)){
            $file = public_path('save_image'). '/' . $fileName;
            if(file_exists($file)){
                unlink($file);
            }
        }
    }

    /**
     * @Route("admin/common/delete-image")
     * @param Request $request
     */
    public function doDeleteImage(Request $request){
        $fileName = $request->get('file');
        if(isset($fileName)){
            $file = public_path('save_image'). '/' . $fileName;
            if(file_exists($file)){
                unlink($file);
                ProductImage::where('file_name','=',$fileName)->delete();
            }
        }
    }

    /**
     * @Route("admin/common/upload-image")
     * @param Request $request
     * @return JsonResponse
     */
    public function doAddImage(Request $request){
        $data = array();
        $fileName = $request->file('files');
        foreach ($fileName as $item) {
            $extension = $item->getClientOriginalExtension();
            $dir = public_path('save_image');
            $file_name = uniqid() . '_' . time() . '.' . $extension;
            $item->move($dir, $file_name);
            $data['iSuccess'] = true;
            $data['fileName'] = $file_name;
        }

        return \response()->json($data);
    }
}
