<?php


namespace App\ServiceIml\Shop;


use Illuminate\Database\Eloquent\Builder;

interface HomeService
{

    function catalogs();

    function productSelling();

    function productNew();

    function sliders();

}
