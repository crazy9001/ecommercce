<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 10/26/2018
 * Time: 11:08 AM
 */

namespace App\Http\Controllers\Frontend;


class ErrorController extends FrontendController
{
    public function error404()
    {
        return abort(404);
    }

    public function error500()
    {
        return abort(500);
    }
}