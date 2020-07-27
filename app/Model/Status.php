<?php


namespace App\Model;


/**
 * @property integer id
 * @property string status_name
 */
class Status extends BaseModel
{
    protected $table = "mtb_status";

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
     * @return string
     */
    public function getStatusName()
    {
        return $this->status_name;
    }

    /**
     * @param $status_name
     */
    public function setStatusName($status_name)
    {
        $this->status_name = $status_name;
    }


}
