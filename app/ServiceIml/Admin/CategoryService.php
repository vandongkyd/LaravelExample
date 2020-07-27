<?php


namespace App\ServiceIml\Admin;


use Illuminate\Http\Request;

interface CategoryService
{
    function list();

    function listUse();

    function add(Request $request);

    function edit(Request $request, $id);

    function delete(Request $request);

    function fetchById($id);

    function validation(Request $request, $mod);
}
