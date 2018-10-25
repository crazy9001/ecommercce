<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_item';
    protected $guarded = [];
    public $timestamps = false;

    public $filter = ['order_id', 'pro_id', 'pro_thumb', 'pro_name', 'qty', 'price', 'subtotal'];


    public function createOrderItem($data)
    {
        return $this->create(array_only($data, $this->filter));
    }

    public function updateOrderItem($data, $id)
    {
        $item = $this->find($id);
        if ($item) {
            $item->update(array_only($data, $this->filter));
        }

        return $item;

    }

}
