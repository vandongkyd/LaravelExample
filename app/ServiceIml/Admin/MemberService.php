<?php


namespace App\ServiceIml\Admin;


use Illuminate\Http\Request;

interface MemberService
{
    function list();

    function add(Request $request);

    function edit(Request $request, $id);

    function delete(Request $request);

    function reset(Request $request);

    function lock(Request $request);

    function unlock(Request $request);

    function fetchById($id);

    function validation(Request $request);
}
