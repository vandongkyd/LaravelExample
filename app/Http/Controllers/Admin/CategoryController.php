<?php


namespace App\Http\Controllers\Admin;


use App\ServiceIml\Admin\CategoryService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends CommonController implements CommonAction
{

    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * CategoryController constructor.
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->middleware('auth:admin');
        $this->categoryService = $categoryService;
    }

    /**
     * @Route("admins/category/list")
     * @Array list category
     * @return Factory|View
     */
    function index()
    {
        $categories = $this->categoryService->list();
        return view("admin.category.index",[
            "categories" => $categories
        ]);
    }

    /**
     * @Route("admins/catalog/add")
     * @param Request $request
     * @return Factory|View
     */
    function add(Request $request)
    {
        return view("admin.category.add");
    }

    /**
     * @Route("admins/catalog/edit/{id}")
     * @param $id
     * @return Factory|View
     */
    function edit($id)
    {
        $category = $this->categoryService->fetchById($id);
        return view("admin.category.edit",[
            "category" => $category
        ]);
    }

    /**
     * @Route("admins/catalog/add")
     * @Method POST
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    function doAdd(Request $request)
    {
        try{
            $request["creator"] = Auth::guard('admin')->user()->id;
            $category = $this->categoryService->add($request);
            $redirect = $this->FactoryAndMessage($category,"category.list","Category","add");
            return $redirect;
        }catch (\Exception $ex){
            Log::debug($ex->getMessage());
            return view('admin.error.502');
        }
    }

    /**
     * @Route("admins/catalog/edit")
     * @Method POST
     * @param Request $request
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    function doEdit(Request $request, $id)
    {
        try{
            $category = $this->categoryService->edit($request, $id);
            $redirect = $this->FactoryAndMessage($category,"category.list","Category","edit");
            return $redirect;
        }catch (\Exception $ex){
            Log::debug($ex->getMessage());
            return view('admin.error.502');
        }
    }

    /**
     * @Route("admins/catalog/delete")
     * @Method POST
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    function doDelete(Request $request)
    {
        try{
            $category = $this->categoryService->delete($request);
            $redirect = $this->FactoryAndMessage($category,"category.list","Category","delete");
            return $redirect;
        }catch (\Exception $ex){
            Log::debug($ex->getMessage());
            return view('admin.error.502');
        }
    }
}
