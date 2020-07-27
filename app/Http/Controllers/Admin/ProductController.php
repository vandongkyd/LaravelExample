<?php


namespace App\Http\Controllers\Admin;


use App\ServiceIml\Admin\CategoryService;
use App\ServiceIml\Admin\ProductService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends CommonController implements CommonAction
{

    /**
     * @var ProductService
     */
    private $productService;

    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * ProductController constructor.
     * @param ProductService $productService
     * @param CategoryService $categoryService
     */
    public function __construct(ProductService $productService,
                                CategoryService $categoryService)
    {
        $this->middleware("auth:admin");
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    /**
     * @Route("admins/product/list")
     * @Array list product
     * @return Factory|View
     */
    function index()
    {
        $products = $this->productService->list();
        return view("admin.product.index",[
            "products" => $products
        ]);
    }

    /**
     * @Route("admins/product/add")
     * @param Request $request
     * @return Factory|View
     */
    function add(Request $request)
    {
        $categories = $this->categoryService->listUse();
        return view("admin.product.add",[
            "categories" => $categories,
        ]);
    }

    /**
     * @Route("admins/product/edit")
     * @param $id
     * @return Factory|View
     */
    function edit($id)
    {
        $product = $this->productService->fetchById($id);
        $categories = $this->categoryService->listUse();
        return view("admin.product.edit",[
            "categories" => $categories,
            "product" => $product
        ]);
    }

    /**
     * @Route("admins/product/add")
     * @Method POST
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    function doAdd(Request $request)
    {
        try {
            $request["creator"] = Auth::guard('admin')->user()->id;
            $product = $this->productService->add($request);
            $redirect = $this->FactoryAndMessage($product,"product.list","Product","add");
            return $redirect;
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return view('admin.error.502');
        }
    }

    /**
     * @Route("admins/product/edit")
     * @Method POST
     * @param Request $request
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    function doEdit(Request $request, $id)
    {
        try {
            $product = $this->productService->edit($request,$id);
            $redirect = $this->FactoryAndMessage($product,"product.list","Product","edit");
            return $redirect;
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return view('admin.error.502');
        }
    }

    /**
     * @Route("admins/product/delete")
     * @Method POST
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    function doDelete(Request $request)
    {
        try {
            $product = $this->productService->delete($request);
            $redirect = $this->FactoryAndMessage($product,"product.list","Product","delete");
            return $redirect;
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return view('admin.error.502');
        }
    }
}
