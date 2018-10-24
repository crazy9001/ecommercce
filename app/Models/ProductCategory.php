<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class ProductCategory extends Category
{

    public static function getCategory()
    {
        return self::buildTreeInMenu('product');
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', 'product');
        });
    }
}
