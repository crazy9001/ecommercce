<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    protected $table = 'menu';
    protected $guarded = [];
    public $filter = ['parent_id', 'position', 'type', 'type_id', 'link', 'title', 'new_tab', 'sort_order'];

    public function parent()
    {
        return $this->hasOne('App\Models\Menu', 'id', 'parent_id');
    }

    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'type_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Menu', 'parent_id', 'id');
    }

    public function createMenu($data)
    {
        DB::beginTransaction();
        $menu_item = $this->create(array_only($data, $this->filter));
        DB::commit();
        return $menu_item;
    }

    public function updateMenu($data, $id)
    {
        $menu_item = $this->find($id);
        if ($menu_item) {
            DB::beginTransaction();
            $menu_item->update(array_only($data, $this->filter));
            DB::commit();
        }
        return $menu_item;

    }

    /*Lấy các danh sách danh id tất cả mục con*/
    public static function getListIdMenuChild($ids)
    {
        $ids = Menu::whereIn('parent_id', $ids)->pluck('id')->toArray();
        if (count($ids)) {
            $ids = array_merge_recursive($ids, self::getListIdMenuChild($ids));
        }
        return $ids;
    }

}
