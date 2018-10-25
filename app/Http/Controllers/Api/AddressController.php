<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 10/25/2018
 * Time: 3:35 PM
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function getProvince(){
        return DB::table('province')->get();
    }

    public function getDistrict(Request $request){
        $data = $request->all();
        return DB::table('district')->where('province_id', $data['province_id'])->get();
    }
}