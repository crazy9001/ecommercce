<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
/*use App\Models\Lang;
use App\Models\Setting;
use Carbon\Carbon;*/

class BackendController extends Controller
{
    function __construct()
    {
    }

//    public function formatDateTime($dateTime){
//        return Carbon::createFromFormat('d/m/Y H:i', $dateTime)->format('Y-m-d H:i');
//    }

    public function response($route = null, $data_ajax = [])
    {
        if (request()->ajax()) {
            return [
                    'code' => 1,
                    'msg' => 'Cập nhật thành công!'
                ] + $data_ajax;
        }

        session()->flash('success', 'Cập nhật thành công!');

        if ($route) {
            return redirect($route);
        }
        return redirect()->back();

    }
}
