<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTables;

class Page extends Category
{

    public function createPage($data)
    {
        $data['type'] = 'page';
        $page = $this->createCategory($data);
        return $page;

    }

    public function updatePage($data, $id)
    {
        $page = $this->updateCategory($data, $id);
        return $page;

    }

    public static function dataTable()
    {
        $model = self::sortOrder()->select(['*']);
        return DataTables::of($model)
            ->addColumn('route_edit', function ($page) {
                return route('page.edit', $page->id);
            })
            ->addColumn('route_delete', function ($page) {
                return route('page.destroy', $page->id);
            })
            ->addColumn('route_view', function ($page) {
                return \Pages::urlPage($page);
            })
            ->make(true);
    }

    public static function getPageInMenu()
    {
        return self::get();
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', 'page');
        });
    }
}
