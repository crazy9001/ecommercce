<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Category extends BaseModel
{
    protected $table = 'category';
    protected $guarded = [];
    public $filter = ['title', 'description', 'slug', 'thumb', 'gallery', 'icon', 'type', 'content_id', 'seo_id', 'parent_id', 'sort_order'];


    public function parent()
    {
        return $this->hasOne('App\Models\Category', 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id');
    }


    public static function getChildren($id = null)
    {
        return self::where('parent_id', $id)->pluck('id')->toArray();
    }

    public static function getAllChildren($id = array(null))
    {
        $ids = self::whereIn('parent_id', $id)->pluck('id')->toArray();
        if (count($ids)) {
            $ids = array_merge_recursive($ids, self::getAllChildren($ids));
        }
        return $ids;
    }

    public function content()
    {
        return $this->hasOne('App\Models\Content', 'id', 'content_id');
    }

    public function seo()
    {
        return $this->hasOne('App\Models\SEO', 'id', 'seo_id');
    }

    public function createCategory($data)
    {
        DB::beginTransaction();
        $seo = (new SEO())->createSEO($data);
        $content = (new Content())->createContent($data);
        $data['seo_id'] = $seo->id;
        $data['content_id'] = $content->id;
        $data['sort_order'] = $this->max('sort_order') + 1;
        $category = $this->create(array_only($data, $this->filter));
        DB::commit();
        return $category;
    }

    public function updateCategory($data, $id)
    {
        $category = $this->with(['seo', 'content'])->find($id);
        if ($category) {
            DB::beginTransaction();
            $category->update(array_only($data, $this->filter));
            $category->seo->update(array_only($data, (new SEO())->filter));
            $category->content->update(array_only($data, (new Content())->filter));
            DB::commit();
        }

        return $category;

    }

    public function deleteCategory($id)
    {
        $cat_child_ids = static::getAllChildren([$id]);
        foreach ($cat_child_ids as $child_id) {
            $this->find($child_id)->delete();
        }

        return $this->find($id)->delete();

    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            $category->content()->delete();
            $category->seo()->delete();
        });
    }

    public static function buildTree($type, $id_expect = null)
    {
        $categories_arr = [];
        if ($id_expect) {
            $categories = self::where('id', '<>', $id_expect)->where('type', $type)->orderBy('sort_order')->get();
        } else {
            $categories = self::where('type', $type)->orderBy('sort_order')->get();
        }

        $root = $categories->where('parent_id', 0);
        foreach ($root as $category) {
            $categories_arr[$category->id] = $category->title;
            $root1 = $categories->where('parent_id', $category->id);
            foreach ($root1 as $category) {
                $categories_arr[$category->id] = '— ' . $category->title;
                $root2 = $categories->where('parent_id', $category->id);
                foreach ($root2 as $category) {
                    $categories_arr[$category->id] = '— — ' . $category->title;
                    $root3 = $categories->where('parent_id', $category->id);
                    foreach ($root3 as $category) {
                        $categories_arr[$category->id] = '— — —' . $category->title;
                        $root4 = $categories->where('parent_id', $category->id);
                        foreach ($root4 as $category) {
                            $categories_arr[$category->id] = '— — — —' . $category->title;
                        }
                    }

                }
            }
        }

        return $categories_arr;
    }

    public static function buildTreeInMenu($type)
    {
        $categories_arr = [];
        $categories = self::where('type', $type)->orderBy('sort_order')->get();
        $root = $categories->where('parent_id', 0);
        foreach ($root as $category) {
            $category->title_tree = $category->title;
            array_push($categories_arr, $category);
            $root1 = $categories->where('parent_id', $category->id);
            foreach ($root1 as $category) {
                $category->title_tree = '— ' . $category->title;
                array_push($categories_arr, $category);
                $root2 = $categories->where('parent_id', $category->id);
                foreach ($root2 as $category) {
                    $category->title_tree = '— — ' . $category->title;
                    array_push($categories_arr, $category);
                    $root3 = $categories->where('parent_id', $category->id);
                    foreach ($root3 as $category) {
                        $category->title_tree = '— — — ' . $category->title;
                        array_push($categories_arr, $category);
                        $root4 = $categories->where('parent_id', $category->id);
                        foreach ($root4 as $category) {
                            $category->title_tree = '— — — — ' . $category->title;
                            array_push($categories_arr, $category);
                        }
                    }

                }
            }
        }

        return $categories_arr;
    }

    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }


}
