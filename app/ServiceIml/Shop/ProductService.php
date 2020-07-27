<?php


namespace App\ServiceIml\Shop;


use Illuminate\Http\Request;

interface ProductService
{
    function fetchById($id);

    function list(Request $request);

    function productRelated($category, $id);
}
