<?php


namespace App\ServiceIml\Admin;


use App\Model\Member;
use Illuminate\Http\Request;

interface SettingService
{
    function changePassword(Request $request, $id);

    function profile(Request $request, $id);

    function fetchById($id);

    function validation(Request $request, $mod, Member $member);

}
