<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 10/24/2018
 * Time: 10:18 AM
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        dd(Auth::user());
    }
}