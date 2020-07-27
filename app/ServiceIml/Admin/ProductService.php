<?php


namespace App\ServiceIml\Admin;


use Illuminate\Http\Request;

interface ProductService
{
    function list();

    function add(Request $request);

    function edit(Request $request, $id);

    function delete(Request $request);

    function fetchById($id);

    function validation(Request $request, $mod = false);

    function AddImageNote($description);

    function EditImageNote($description);
}
