<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 10/25/2018
 * Time: 3:16 PM
 */

namespace App\Http\Controllers\Backend;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BackendController
{
    public function index(Request $request)
    {
        return view('backend.user.index');
    }

    public function dataTable(Request $request)
    {
        return User::dataTable();
    }

    public function show($id, Request $request)
    {
        $user = User::with(['district', 'province'])->find($id);
        return view('backend.user.show')->with('user', $user);
    }

    public function destroy($id, Request $request)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return [
                'code' => 1,
                'msg' => 'Cập nhật thành công!',
                'datatable' => true
            ];
        }
        return [
            'code' => -1,
            'msg' => 'Cập nhật thất bại!',
        ];

    }
}