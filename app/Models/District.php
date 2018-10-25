<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class District extends Model
{
    protected $table = 'district';
    protected $guarded = [];
    public $timestamps = false;
}
