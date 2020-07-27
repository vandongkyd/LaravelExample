<?php


namespace App\Model;

/**
 * @property integer id
 * @property string role_name
 */
class Role extends BaseModel
{
    protected $table = "mtb_role";

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
    public function getRoleName()
    {
        return $this->role_name;
    }

    /**
     * @param $role_name
     */
    public function setRoleName($role_name)
    {
        $this->role_name = $role_name;
    }


}
