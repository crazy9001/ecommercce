<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 10/24/2018
 * Time: 9:50 AM
 */

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends BackendController
{
    public function dashboard(Request $request)
    {
        return view('backend.dashboard');
    }

    public function profile(Request $request)
    {
        if ($request->isMethod('POST')) {
            $user = Auth::user();
            $this->validate($request, [
                'user.name' => 'required|max:255',
                'user.email' => "required|email|unique:users,email",
                'password' => 'confirmed',
            ], [
                'user.email.unique' => 'Email đã tồn tại vui lòng sử dụng email khác',
                'password.confirmed' => 'Mật khẩu không chính xác'
            ]);
            $data = $request->input();
            if ($data['password']) {
                $data['user']['password'] = bcrypt($data['password']);
            }
            $user->update($data['user']);
            return back();
        }

        return view('backend.profile');
    }

}