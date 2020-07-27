<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\ServiceIml\Admin\DashboardService;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends Controller
{
    private $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->middleware('auth:admin');
        $this->dashboardService = $dashboardService;
    }

    /**
     * @Route("admins/dashboard")
     * @Array list product
     * @return Factory|View
     */
    public function index(){
        return view("admin.dashboard.index");
    }
}
