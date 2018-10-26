<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTables;

class ProductWidget extends Widget
{

    public function createProductWidget($data)
    {
        $data['type'] = 'product_widget';
        $product_widget = $this->createWidget($data);
        return $product_widget;
    }

    public static function dataTable()
    {
        $model = self::sortOrder()->select(['*']);
        return DataTables::of($model)
            ->addColumn('route_edit', function ($product_widget) {
                return route('widget.product_widget.edit', $product_widget->id);
            })
            ->addColumn('route_delete', function ($product_widget) {
                return route('widget.product_widget.destroy', $product_widget->id);
            })
            ->make(true);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', 'product_widget');
        });
    }
}
