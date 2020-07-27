<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    const ADD = 'add';
    const EDIT = 'edit';
    const DELETE = 1;
    const DEl_FLG = 0;
    const USE = 1;
    const NOT_USE = 0;
    const DEFAULT = 0;
    public $timestamps = false;
}
