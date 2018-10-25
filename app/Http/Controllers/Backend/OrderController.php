<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 10/25/2018
 * Time: 2:36 PM
 */

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends BackendController
{
    public function index(Request $request)
    {
        return view('backend.order.index');
    }

    public function dataTable(Request $request)
    {
        return Order::dataTable();
    }

    public function show($id)
    {
        $order = Order::with(['items', 'province', 'district', 'sprovince', 'sdistrict'])->find($id);

        if (!$order) {
            return redirect()->route('order.index');
        }
        return view('backend.order.show')->with('order', $order);


    }

    public function update($id, Request $request)
    {
        $data = $request->except(['_method', '_token']);

        $orderModel = new Order();
        $orderModel->updateOrder($data, $id);

        return $this->response(null, ['reload' => true]);
    }
}