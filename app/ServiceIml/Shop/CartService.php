<?php


namespace App\ServiceIml\Shop;


use App\Model\CartItem;
use App\Model\Customer;
use Illuminate\Http\Request;

interface CartService
{
    function list($id);

    function add(Request $request, Customer $customer = null);

    function quality(Request $request);

    function delete(Request $request);

    function getCartKey(Customer $customer = null);

    function createCartKey($allocatedId, Customer $customer = null);

    function mergeCartItem(CartItem $cartCurrent, Request $request);

    function compare(CartItem $item1, Request $request);

    function setNonUser($token);

    function getNoneUser();

    function checkNoneUser();
}
