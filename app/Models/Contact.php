<?php

namespace App\Models;

use Yajra\DataTables\DataTables;

class Contact extends BaseModel
{
    protected $table = 'contact';
    protected $guarded = [];

    public static function dataTable()
    {
        $model = self::orderBy('read')->orderBy('id', 'desc')->select(['*']);
        return DataTables::of($model)
            ->addColumn('route_update', function ($contact) {
                return route('contact.update', $contact->id);
            })
            ->addColumn('route_delete', function ($contact) {
                return route('contact.destroy', $contact->id);
            })
            ->editColumn('created_at', function ($contact) {
                return $contact->created_at->format('d/m/Y H:i');
            })
            ->make(true);
    }

    public static function countNew()
    {
        return self::where('read', 0)->count();
    }
}
