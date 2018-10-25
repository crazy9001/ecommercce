<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class PostCategory extends Category
{

    public static function getCategory()
    {
        return self::buildTreeInMenu('post');
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', 'post');
        });
    }
}
