<?php

namespace App\Model;

/**
 * @property integer id
 * @property integer product_id
 * @property string file_name
 */
class ProductImage extends BaseModel
{
    protected $table = "dtb_product_image";

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
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param $product_id
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->file_name;
    }

    /**
     * @param $file_name
     */
    public function setFileName($file_name)
    {
        $this->file_name = $file_name;
    }


}
