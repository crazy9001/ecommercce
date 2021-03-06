<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Yajra\DataTables\DataTables;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'avatar', 'email', 'phone', 'gender', 'province_id', 'district_id', 'address', 'password', 'user_type', 'facebook', 'google'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function province()
    {
        return $this->hasOne('App\Models\Province', 'id', 'province_id');
    }

    public function district()
    {
        return $this->hasOne('App\Models\District', 'id', 'district_id');
    }

    public static function dataTable()
    {
        $model = self::where('user_type', '=', 2)->select(['*']);
        return DataTables::of($model)
            ->addColumn('route_show', function ($user) {
                return route('user.show', $user->id);
            })
            ->addColumn('route_delete', function ($user) {
                return route('user.destroy', $user->id);
            })
            ->make(true);;
    }
}
