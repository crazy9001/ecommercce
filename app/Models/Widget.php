<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Widget extends BaseModel
{
    protected $table = 'widget';
    protected $guarded = [];
    public $filter = ['title', 'thumb', 'type', 'config', 'active', 'sort_order'];


    protected $casts = [
        'config' => 'array',
    ];

    public function createWidget($data)
    {
        $data['sort_order'] = $this->max('sort_order') + 1;
        DB::beginTransaction();
        $widget = $this->create(array_only($data, $this->filter));
        DB::commit();
        return $widget;
    }

    public function updateWidget($data, $id)
    {
        $widget = $this->find($id);
        if ($widget) {
            DB::beginTransaction();
            $widget->update(array_only($data, $this->filter));
            DB::commit();
        }
        return $widget;

    }
}
