<?php


namespace App\Repository\Shop;


use App\Model\Catalog;
use App\Model\Category;
use App\Model\Product;
use App\Model\Slider;
use App\ServiceIml\Shop\HomeService;
use Illuminate\Database\Eloquent\Builder;

class HomeRepository implements HomeService
{

    function catalogs()
    {
        return Catalog::where("del_flg", Catalog::DEl_FLG)->get()->take(5);
    }

    function productSelling()
    {
        return Product::where("del_flg", "=",Product::DEl_FLG)
            ->where("product_status", "=", Product::USE)
            ->orderBy("product_selling","desc")
            ->get()
            ->take(8);
    }

    function productNew()
    {
        return Product::where("del_flg","=",Product::DEl_FLG)
            ->where("product_status","=", Product::USE)
            ->whereDate('created','>=', date("Y-m-d",strtotime("-15days", time())))
            ->get()
            ->take(8);
    }

    function sliders()
    {
        return Slider::with(["Product"])->where("del_flg", "=", Slider::DEl_FLG)
            ->where("slider_status","=",Slider::USE)
            ->get();
    }
}
