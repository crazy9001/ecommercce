<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 10/25/2018
 * Time: 12:04 PM
 */

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Backend\BackendController;
use App\Models\Setting;
use File;

class SEOController extends BackendController
{
    public function index()
    {
        $seo = Setting::getValue('seo');
        return view('backend.setting.seo.index', ['seo' => $seo]);
    }
}