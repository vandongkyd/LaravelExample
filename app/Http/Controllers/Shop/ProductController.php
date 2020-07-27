<?php


namespace App\Http\Controllers\Shop;


use App\Http\Controllers\Controller;
use App\Model\Product;
use App\ServiceIml\Shop\ProductService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends CommonController
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @Route("product/list")
     * @Array list product
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request){
        $products = $this->productService->list($request);
        return \view("shop.product.index",[
            "products" => $products
        ]);
    }

    /**
     * @Route("product/detail/{id}")
     * @param $id
     * @return Factory|View
     */
    public function detail($id){
        $product = $this->productService->fetchById($id);
        $productRelated = $this->productService->productRelated($product->getCategoryId(), $id);
        return \view("shop.product.detail",[
            "product" => $product,
            "productRelated" => $productRelated
        ]);
    }
}
