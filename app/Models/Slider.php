<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTables;

class Slider extends Widget
{

    public function createSlider($data)
    {
        $data['type'] = 'slider';
        $slider = $this->createWidget($data);
        return $slider;
    }

    public static function dataTable()
    {
        $model = self::sortOrder()->select(['*']);
        return DataTables::of($model)
            ->addColumn('route_edit', function ($slider) {
                return route('widget.slider.edit', $slider->id);
            })
            ->addColumn('route_delete', function ($slider) {
                return route('widget.slider.destroy', $slider->id);
            })
            ->make(true);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', 'slider');
        });
    }
}
