<?php


namespace App\Http\Controllers\Shop;


use App\ServiceIml\Shop\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends CommonController
{
    /**
     * @var CartService
     */
    private $cartService;

    /**
     * CartController constructor.
     * @param CartService $cartService
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(){
//        $id = Auth::guard("web")->user()->id;
        $id = 1;
//        $cart = $this->cartService->list($id);
        return view('shop.cart.index',[
//            "cart" => $cart
        ]);
    }


    public function doAdd(Request $request){
        $cartKey = null;
//        if (Session::has('cartKey')){
//            $cartKey = $this->cartService->getNoneUser();
//        }else{
//            $allocatedId = 'common_cart';
//            $cartKey = $this->cartService->createCartKey($allocatedId,null);
//            $this->cartService->setNonUser($cartKey);
//        }
        dd($this->cartService->getNoneUser());
    }

    public function doRemove(Request $request){

    }
}
