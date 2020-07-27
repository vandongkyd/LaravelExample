<?php


namespace App\Providers;



use App\Repository\Admin\CategoryRepository;
use App\Repository\Admin\CustomerRepository;
use App\Repository\Admin\DashboardRepository;

use App\Repository\Admin\MemberRepository;

use App\Repository\Admin\ProductRepository;
use App\Repository\Admin\SettingRepository;


use App\ServiceIml\Admin\CategoryService;
use App\ServiceIml\Admin\CustomerService;
use App\ServiceIml\Admin\DashboardService;

use App\ServiceIml\Admin\MemberService;

use App\ServiceIml\Admin\ProductService;
use App\ServiceIml\Admin\SettingService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AdminAppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Admin
        $this->app->singleton(DashboardService::class, function (){
            return new DashboardRepository();
        });


        $this->app->singleton(CategoryService::class, function (){
            return new CategoryRepository();
        });

        $this->app->singleton(ProductService::class, function (){
            return new ProductRepository();
        });


        $this->app->singleton(MemberService::class, function (){
            return new MemberRepository();
        });

        $this->app->singleton(CustomerService::class, function (){
            return new CustomerRepository();
        });

        $this->app->singleton(SettingService::class, function (){
            return new SettingRepository();
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
