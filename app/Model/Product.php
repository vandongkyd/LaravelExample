<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property integer id
 * @property integer creator_id
 * @property integer category_id
 * @property string product_name
 * @property string product_price
 * @property integer product_quantity
 * @property string product_image
 * @property string product_content
 * @property integer product_view
 * @property integer product_selling
 * @property double product_rating
 * @property integer product_status
 * @property integer del_flg
 * @property string created
 * @property string updated
 */
class Product extends BaseModel
{
    protected $table = "dtb_product";

    /**
     * @return HasMany
     */
    function ProductImage(){
        return $this->hasMany(ProductImage::class , "product_id");
    }

    /**
     * @return HasOne
     */
    function Category(){
        return $this->hasOne(Category::class,"id","category_id")
            ->where("category_status","=",self::USE);
    }

    /**
     * @return HasOne
     */
    function Creator(){
        return $this->hasOne(Member::class,"id","creator_id")
            ->select("id","user_name","full_name","phone","address");
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getCreatorId()
    {
        return $this->creator_id;
    }

    /**
     * @param $creator_id
     */
    public function setCreatorId($creator_id)
    {
        $this->creator_id = $creator_id;
    }

    /**
     * @return int
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @param $category_id
     */
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    /**
     * @return string
     */
    public function getProductName()
    {
        return $this->product_name;
    }

    /**
     * @param $product_name
     */
    public function setProductName($product_name)
    {
        $this->product_name = $product_name;
    }

    /**
     * @return string
     */
    public function getProductPrice()
    {
        return $this->product_price;
    }

    /**
     * @param $product_price
     */
    public function setProductPrice($product_price)
    {
        $this->product_price = $product_price;
    }

    /**
     * @return int
     */
    public function getProductQuantity()
    {
        return $this->product_quantity;
    }

    /**
     * @param $product_quantity
     */
    public function setProductQuantity($product_quantity)
    {
        $this->product_quantity = $product_quantity;
    }

    /**
     * @return string
     */
    public function getProductImage()
    {
        return $this->product_image;
    }

    /**
     * @param $product_image
     */
    public function setProductImage($product_image)
    {
        $this->product_image = $product_image;
    }

    /**
     * @return string
     */
    public function getProductContent()
    {
        return $this->product_content;
    }

    /**
     * @param $product_content
     */
    public function setProductContent($product_content)
    {
        $this->product_content = $product_content;
    }

    /**
     * @return int
     */
    public function getProductStatus()
    {
        return $this->product_status;
    }

    /**
     * @param $product_status
     */
    public function setProductStatus($product_status)
    {
        $this->product_status = $product_status;
    }

    /**
     * @return int
     */
    public function getProductView()
    {
        return $this->product_view;
    }

    /**
     * @param $product_view
     */
    public function setProductView($product_view)
    {
        $this->product_view = $product_view;
    }

    /**
     * @return int
     */
    public function getProductSelling()
    {
        return $this->product_selling;
    }

    /**
     * @param $product_selling
     */
    public function setProductSelling($product_selling)
    {
        $this->product_selling = $product_selling;
    }


    /**
     * @return float
     */
    public function getProductRating()
    {
        return $this->product_rating;
    }

    /**
     * @param $product_rating
     */
    public function setProductRating($product_rating)
    {
        $this->product_rating = $product_rating;
    }

    /**
     * @return int
     */
    public function getDelFlg()
    {
        return $this->del_flg;
    }

    /**
     * @param $del_flg
     */
    public function setDelFlg($del_flg)
    {
        $this->del_flg = $del_flg;
    }

    /**
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return string
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * @return mixed
     */
    public function getProductImages(){
        return $this->getAttribute('ProductImage');
    }

    /**
     * @return mixed
     */
    public function getCategory(){
        return $this->getAttribute("Category");
    }

    /**
     * @return object
     */
    public function getCreator(){
        return $this->getAttribute("Creator");
    }
}
