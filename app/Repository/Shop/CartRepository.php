<?php


namespace App\Repository\Shop;


use App\Core\Util\StringUtil;
use App\Model\Cart;
use App\Model\CartItem;
use App\Model\Customer;
use App\ServiceIml\Shop\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartRepository implements CartService
{

    function list($id)
    {
        $cart = Cart::with(['Customer', 'CartItems'])->where('customer_id', '=', $id)->first();
        return $cart;
    }

    function add(Request $request, Customer $customer = null)
    {
        $cartKey = $this->getCartKey($customer);
        return $cartKey;
    }

    function quality(Request $request)
    {
        // TODO: Implement quality() method.
    }

    function delete(Request $request)
    {
        // TODO: Implement delete() method.
    }

    function getCartKey(Customer $customer = null){
        $allocatedId = 'common_cart';
        $cartKey = null;
        if ($customer == null) {
            if (Session::has('cartKey')) {
                $cartKey = $this->getNoneUser();
            } else {
                $cartKey = $this->createCartKey($allocatedId, null);
                $this->setNonUser($cartKey);
            }
        }else{
            $cartKey = $this->createCartKey($allocatedId, $customer);
        }
        return $cartKey;
    }

    function createCartKey($allocatedId, Customer $customer = null)
    {
        if ($customer != null) {
            return $customer->getId(). '_' .$allocatedId;
        }

        if (Session::has('cart_key_prefix')) {
            return Session::get('cart_key_prefix'). '_' .$allocatedId;
        }

        do {
            $random = StringUtil::random(32);
            $cartKey = $random. '_' .$allocatedId;
            $cart = Cart::where(['cart_key' => $cartKey])->first();
        } while ($cart);

        Session::put('cart_key_prefix', $random);

        return $cartKey;
    }

    function setNonUser($token)
    {
        if (!Session::exists('cartKey')) {
            Session::put('cartKey', $token);
        }
    }

    function getNoneUser()
    {
        return Session::get('cartKey');
    }

    function checkNoneUser()
    {
        return Session::has('cartKey');
    }

    function mergeCartItem(CartItem $cartCurrent, Request $request)
    {
        if ($this->compare($cartCurrent, $request)){
            $cartCurrent->setQuantity($cartCurrent->getQuantity() + $request->get('quantity'));
        }
    }

    function compare(CartItem $item1, Request $request)
    {
        return $item1->getProductId() == $request->get('product_id');
    }
}
