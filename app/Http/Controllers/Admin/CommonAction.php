<?php


namespace App\Http\Controllers\Admin;


use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\Routing\Annotation\Route;

interface CommonAction
{
    /**
     * @Route("admins/{model}/list")
     * @Array list {model}
     * @return Factory|View
     */
    function index();

    /**
     * @Route("admins/{model}/add")
     * @param Request $request
     * @return Factory|View
     */
    function add(Request $request);

    /**
     * @Route("admins/{model}/edit")
     * @param $id
     * @return Factory|View
     */
    function edit($id);

    /**
     * @Route("admins/{model}/add")
     * @Method POST
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    function doAdd(Request $request);

    /**
     * @Route("admins/{model}/edit")
     * @Method POST
     * @param Request $request
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    function doEdit(Request $request, $id);

    /**
     * @Route("admins/{model}/delete")
     * @Method POST
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    function doDelete(Request $request);
}
