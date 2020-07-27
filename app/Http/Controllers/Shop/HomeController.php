<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\ServiceIml\Shop\HomeService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class HomeController extends CommonController
{
    private $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $productNews = $this->homeService->productNew();
        $productSelling = $this->homeService->productSelling();

        return view('shop.home.home', [
            'productNews' => $productNews,
            'productSelling' => $productSelling,
        ]);
    }


}
