<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class Order extends Model
{
    protected $table = 'order';
    protected $guarded = [];

    public $filter = ['code', 'payment', 'payment_status', 'payment_method', 'name', 'gender', 'phone', 'email', 'address', 'district_id', 'province_id', 'ship_another_address', 'sname', 'saddress', 'sdistrict_id', 'sprovince_id', 'note', 'status', 'delivery_time', 'total'];

    public function items()
    {
        return $this->hasMany('App\Models\OrderItem', 'order_id', 'id');
    }

    public function province()
    {
        return $this->hasOne('App\Models\Province', 'id', 'province_id');
    }

    public function district()
    {
        return $this->hasOne('App\Models\District', 'id', 'district_id');
    }

    public function sprovince()
    {
        return $this->hasOne('App\Models\Province', 'id', 'sprovince_id');
    }

    public function sdistrict()
    {
        return $this->hasOne('App\Models\District', 'id', 'sdistrict_id');
    }

    public static function dataTable()
    {
        $model = self::with('items')->orderBy('id', 'desc')->select(['*']);
        return DataTables::of($model)
            ->editColumn('created_at', function ($order) {
                return $order->created_at->format('d/m/Y H:i');
            })
            ->addColumn('route_show', function ($order) {
                return route('order.show', $order->id);
            })
            ->editColumn('status', function ($order) {
                return config("info.order_status.$order->status");
            })
            ->make(true);
    }

    public function createOrder($data)
    {
        DB::beginTransaction();
        $order = $this->create(array_only($data, $this->filter));
        foreach ($data['items'] as $item) {
            $order->items()->create(array_only($item, (new OrderItem())->filter));
        }
        DB::commit();
        return $order;
    }

    public function updateOrder($data, $id)
    {
        $order = $this->with(['items'])->find($id);
        if ($order) {
            DB::beginTransaction();
            $order->update(array_only($data, $this->filter));
            DB::commit();
        }

        return $order;
    }

    public static function countStatus($status = 1)
    {
        return self::where('status', $status)->count();
    }

}
