<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 10/29/2018
 * Time: 10:25 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTables;

class MostViewProductWidget extends Widget
{
    public function createMostViewProductWidget($data)
    {
        $data['type'] = 'most_view_product';
        $count_widget = $this->where('type', '=', $data['type'])->count();
        if($count_widget < 1){
            $product_widget = $this->createWidget($data);
            return $product_widget;
        }
    }

    public static function dataTable()
    {
        $model = self::sortOrder()->select(['*']);
        return DataTables::of($model)
            ->addColumn('route_edit', function ($product_widget) {
                return route('widget.most_view_product.edit', $product_widget->id);
            })
            ->addColumn('route_delete', function ($product_widget) {
                return route('widget.most_view_product.destroy', $product_widget->id);
            })
            ->make(true);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', 'most_view_product');
        });
    }

}