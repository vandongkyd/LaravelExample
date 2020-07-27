<?php

namespace App\Providers;


use App\Http\Controllers\Shop\InfoController;
use App\Model\Catalog;
use App\Model\Contact;
use App\Repository\Shop\CartRepository;
use App\Repository\Shop\HomeRepository;
use App\Repository\Shop\InfoRepository;
use App\Repository\Shop\ProductRepository;
use App\ServiceIml\Shop\CartService;
use App\ServiceIml\Shop\HomeService;
use App\ServiceIml\Shop\InfoService;
use App\ServiceIml\Shop\ProductService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Shop
        $this->app->singleton(HomeService::class, function (){
            return new HomeRepository();
        });

        $this->app->singleton(ProductService::class, function (){
            return new ProductRepository();
        });

        $this->app->singleton(InfoService::class, function (){
            return new InfoRepository();
        });

        $this->app->singleton(CartService::class, function (){
            return new CartRepository();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
