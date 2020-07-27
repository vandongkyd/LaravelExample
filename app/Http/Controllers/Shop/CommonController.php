<?php


namespace App\Http\Controllers\Shop;


use App\Http\Controllers\Controller;
use App\Model\Contact;

class CommonController extends Controller
{
    const COMMON_TEXT = "PLAYTHING_";
    public function getContact(){
        return Contact::first();
    }
}
