<?php


namespace App\Repository\Shop;


use App\Model\Product;
use App\ServiceIml\Shop\ProductService;
use Illuminate\Http\Request;

class ProductRepository implements ProductService
{

    function fetchById($id)
    {
        return Product::with(["Category","ProductImage"])->findOrFail($id);
    }

    function list(Request $request)
    {
        $name = $request->get("product_name");
        $products = Product::with(["Category"])
            ->where("del_flg","=",Product::DEl_FLG)
            ->where("product_status","=",Product::USE)
            ->where(function ($query) use ($name) {
                if (!empty($name)) {
                    $query->where("product_name", 'LIKE', '%' . $name . '%');
                }
            })->paginate(16);
        return $products;
    }

    function productRelated($category, $id)
    {
        return Product::with(["Category"])
            ->where("del_flg","=",Product::DEl_FLG)
            ->where("product_status","=",Product::USE)
            ->where("category_id","=", $category)
            ->where("id","<>",$id)
            ->get()
            ->take(4);
    }
}
