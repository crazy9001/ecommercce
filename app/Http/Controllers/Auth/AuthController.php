<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 10/24/2018
 * Time: 10:45 AM
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }
}