<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 10/25/2018
 * Time: 11:55 AM
 */

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Backend\BackendController;
use App\Models\Setting;
use File;
use Illuminate\Http\Request;

class SettingController extends BackendController
{
    public function index()
    {
        $keys = ['status', 'favicon', 'contact', 'contact_editor'];
        $settings = Setting::getValue($keys);
        return view('backend.setting.general.index')->with('settings', $settings);
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        return $this->response();
    }
}