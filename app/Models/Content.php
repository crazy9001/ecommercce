<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'content';
    public $timestamps = false;
    protected $guarded = [];

    public $filter = ['content'];

    public function createContent($data)
    {
        return $this->create(array_only($data, $this->filter));
    }

    public static function getContent($id)
    {
        $content = self::find($id);
        return $content ? $content->content : null;
    }
}
