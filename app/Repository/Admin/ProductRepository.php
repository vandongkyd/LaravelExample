<?php


namespace App\Repository\Admin;


use App\Model\Product;
use App\Model\ProductImage;
use App\ServiceIml\Admin\ProductService;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductRepository implements ProductService
{

    function list()
    {
        $products = Product::with(["Category", "Creator"])
            ->where("del_flg",'=', Product::DEl_FLG)
            ->get();
        return $products;
    }

    function add(Request $request)
    {
        $validation = $this->validation($request, Product::ADD);

        if ($validation->fails()){
            return [
                "status" => false,
                "validate" => $validation
            ];
        }

        $file_upload = $request->file('product_image');
        $product_image = uniqid() . '_' . time() . '.' . $file_upload->getClientOriginalExtension();
        $file_upload->move(public_path('save_image'), $product_image);

        $product = new Product();
        $product->setCreatorId($request->get("creator"));
        $product->setCategoryId($request->get("category"));
        $product->setProductName($request->get("product_name"));
        $product->setProductQuantity($request->get("product_quantity"));
        $product->setProductPrice($request->get("product_price"));
        $product->setProductStatus($request->get("product_status"));
        $product->setProductView(Product::DEFAULT);
        $product->setProductRating(Product::DEFAULT);
        $product->setProductSelling(Product::DEFAULT);
        $product->setProductImage($product_image);
        $product->setProductContent($request->get("product_content"));
        $product->setDelFlg(Product::DEl_FLG);
        $product->setCreated(new \DateTime());
        $product->setUpdated(new \DateTime());
        if ($product->save()){

            $product_images = $request->get('product_images');
            for ($i = 0; $i < count((array)$product_images); $i++) {
                $productImage = new ProductImage();
                $productImage->setProductId($product->getId());
                $productImage->setFileName($product_images[$i]);
                $productImage->save();
            }
        }

        return [
            "status" => true,
        ];
    }

    function edit(Request $request, $id)
    {
        $validation = $this->validation($request);

        if ($validation->fails()){
            return [
                "status" => false,
                "validate" => $validation
            ];
        }
        $product = $this->fetchById($id);
        if ($product instanceof Product) {

            $file_upload = $request->file('product_image');
            $content = $request->get("product_content");
            if (isset($file_upload)) {
                $product_image = uniqid() . '_' . time() . '.' . $file_upload->getClientOriginalExtension();
                $file_upload->move(public_path('save_image'), $product_image);
                $product->setProductImage($product_image);
            }

            $product->setCategoryId($request->get("category"));
            $product->setProductName($request->get("product_name"));
            $product->setProductQuantity($request->get("product_quantity"));
            $product->setProductPrice($request->get("product_price"));
            $product->setProductStatus($request->get("product_status"));
            $product->setProductContent($this->AddImageNote($content));
            $product->setUpdated(new \DateTime());

            if ($product->save()) {

                $product_images = $request->get('product_images');
                for ($i = 0; $i < count((array)$product_images); $i++) {
                    $productImage = new ProductImage();
                    $productImage->setProductId($product->getId());
                    $productImage->setFileName($product_images[$i]);
                    $productImage->save();
                }
            }
        }

        return [
            "status" => true,
        ];
    }

    function delete(Request $request)
    {
        $product = $this->fetchById($request->get("id"));
        if ($product instanceof Product){
            $product->setDelFlg(Product::DELETE);
            $product->setUpdated(new \DateTime());
            $product->save();
        }

        return [
            "status" => true,
        ];
    }

    function fetchById($id)
    {
        return Product::with("ProductImage")->findOrFail($id);
    }

    function validation(Request $request, $mod = false)
    {
        $validation = Validator::make($request->all(), [
            'category' => [
                'required','max:50',
            ],
            'product_price' => [
                'required','digits_between:2,11','numeric',
            ],
            'product_quantity' => [
                'required','digits_between:1,4','numeric',
            ],
            'product_name' => [
                'required','max:50',
            ],
            'product_status' => [
                'required','max:255',
            ],
            'product_image' => [
               'max:4088',
            ],
            "product_content" => [
                'required'
            ]
        ]);

        if ($mod == Product::ADD){
            $validate_array['product_image'] = 'required';
        }

        return $validation;
    }

    function AddImageNote($description)
    {
        $dom = new DOMDocument();
        $dom->loadHtml('<?xml encoding="utf-8" ?>'.$description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $tagImg = $dom->getElementsByTagName('img');
        foreach ($tagImg as $img) {
            $data = $img->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);
            $image_name = uniqid() . '_' . time() . '.png';
            $path = public_path('save_image') . '/' . $image_name;
            file_put_contents($path, $data);
            $img->removeAttribute('src');
            $img->setAttribute('src', url('/save_image/') . '/' . $image_name);
        }

        return $dom->saveHTML();
    }

    function EditImageNote($description)
    {
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml('<?xml encoding="utf-8" ?>'.$description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $tagImg = $dom->getElementsByTagName('img');
        foreach ($tagImg as $img) {
            $data = $img->getAttribute('src');
            if (!strstr($data, url('/save_image/'))) {
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $data = base64_decode($data);
                $image_name = rand() . time() . '.png';
                $path = public_path('save_image') . '/' . $image_name;
                file_put_contents($path, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', url('/save_image/') . '/' . $image_name);
            }
        }
        return $dom->saveHTML();
    }
}
