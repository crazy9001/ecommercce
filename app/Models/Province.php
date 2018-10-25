<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class Province extends Model
{
    protected $table = 'province';
    protected $guarded = [];
    public $timestamps = false;

    public function district()
    {
        return $this->hasMany('App\Models\District', 'province_id', 'id');
    }
}
