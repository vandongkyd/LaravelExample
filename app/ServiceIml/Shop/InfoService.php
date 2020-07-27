<?php


namespace App\ServiceIml\Shop;


use Illuminate\Http\Request;

interface InfoService
{
    function changePassword(Request $request);

    function fetchById($id);

    function validation(Request $request);
}
