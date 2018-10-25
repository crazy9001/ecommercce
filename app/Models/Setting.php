<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'setting';

    protected $primaryKey = 'key';

    public $timestamps = false;

    public $incrementing = false;

    protected $guarded = [];

    public function getValueAttribute($value)
    {
        return ($data = json_decode($value, true)) ? $data : $value;
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = is_array($value) ? json_encode($value) : $value;
    }

    public static function getValue($keys)
    {
        if (is_array($keys)) {
            return self::whereIn('key', $keys)->pluck('value', 'key');
        } else {
            return ($data = self::find($keys)) ? $data->value : null;
        }
    }

    public static function set($key, $value)
    {
        return self::updateOrCreate(['key' => $key], ['value' => $value]);
    }

}
