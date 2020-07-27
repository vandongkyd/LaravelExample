<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property integer id
 * @property integer creator_id
 * @property string category_name
 * @property integer category_status
 * @property integer del_flg
 * @property string created
 * @property string updated
 */
class Category extends BaseModel
{
    protected $table = "dtb_category";

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
     * @param int $id
     */
    public function setId(int $id)
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
     * @return string
     */
    public function getCategoryName()
    {
        return $this->category_name;
    }

    /**
     * @param $category_name
     */
    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;
    }

    /**
     * @return int
     */
    public function getCategoryStatus()
    {
        return $this->category_status;
    }

    /**
     * @param $category_status
     */
    public function setCategoryStatus($category_status)
    {
        $this->category_status = $category_status;
    }

    /**
     * @return int
     */
    public function getDelFlg()
    {
        return $this->del_flg;
    }

    /**
     * @param int $del_flg
     */
    public function setDelFlg(int $del_flg)
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
     * @return object
     */
    public function getCreator(){
        return $this->getAttribute("Creator");
    }

}
