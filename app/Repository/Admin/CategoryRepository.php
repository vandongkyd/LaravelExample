<?php


namespace App\Repository\Admin;


use App\Model\Category;
use App\ServiceIml\Admin\CategoryService;
use DemeterChain\C;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryRepository implements CategoryService
{

    function list()
    {
        $categories = Category::where('del_flg','=', Category::DEl_FLG)->get();
        return $categories;
    }

    function add(Request $request)
    {
        $validation = $this->validation($request, Category::ADD);

        if ($validation->fails()){
            return [
                "status" => false,
                "validate" => $validation
            ];
        }

        $category = new Category();
        $category->setCreatorId($request->get("creator"));
        $category->setCategoryName($request->get("category_name"));
        $category->setCategoryStatus($request->get("category_status"));
        $category->setDelFlg(Category::DEl_FLG);
        $category->setCreated(new \DateTime());
        $category->setUpdated(new \DateTime());
        $category->save();

        return [
            "status" => true,
        ];
    }

    function edit(Request $request, $id)
    {
        $validation = $this->validation($request, Category::EDIT);
        if ($validation->fails()){
            return [
                "status" => false,
                "validate" => $validation
            ];
        }

        $category = $this->fetchById($id);
        if ($category instanceof Category){
            $file_upload = $request->file('category_image');
            if (isset($file_upload)) {
                $new_name = uniqid() . '_' . time() . '.' . $file_upload->getClientOriginalExtension();
                $file_upload->move(public_path('save_image'), $new_name);
                $category->setCategoryImage($new_name);
            }
            $category->setCategoryName($request->get("category_name"));
            $category->setCategoryStatus($request->get("category_status"));
            $category->setUpdated(new \DateTime());
            $category->save();
        }
        return [
            "status" => true,
        ];
    }

    function delete(Request $request)
    {
        $category = $this->fetchById($request->get("id"));
        if ($category instanceof Category){
            $category->setDelFlg(Category::DELETE);
            $category->setUpdated(new \DateTime());
            $category->save();
        }

        return [
            "status" => true,
        ];
    }

    function fetchById($id)
    {
        return Category::findOrFail($id);
    }

    function validation(Request $request,$mod)
    {
        $validation = Validator::make($request->all(), [
            'category_name' => [
                'required','max:50',
            ],
            'category_status' => [
                'required'
            ]
        ]);
        return $validation;
    }

    function listUse()
    {
        $categories = Category::where('del_flg','=', Category::DEl_FLG)
            ->where('category_status','=', Category::USE)
            ->get();
        return $categories;
    }
}
