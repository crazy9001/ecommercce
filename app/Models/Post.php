<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class Post extends BaseModel
{
    protected $table = 'post';
    protected $guarded = [];

    public $filter = ['title', 'description', 'slug', 'thumb', 'content_id', 'seo_id', 'cat_id', 'active', 'sort_order', 'published_date'];


    public function category()
    {
        return $this->hasOne('App\Models\PostCategory', 'id', 'cat_id');
    }

    public function seo()
    {
        return $this->hasOne('App\Models\SEO', 'id', 'seo_id');
    }

    public function content()
    {
        return $this->hasOne('App\Models\Content', 'id', 'content_id');
    }

    public static function dataTable()
    {
        $model = self::with('category')->sortOrder()->select(['*']);
        if (request()->has('cat_id')) {
            $cat_id = request()->cat_id;
            $cat_ids = array_merge_recursive([$cat_id], PostCategory::getAllChildren([$cat_id]));
            $model = $model->whereIn('cat_id', $cat_ids);
        }

        return DataTables::of($model)
            ->addColumn('route_edit', function ($post) {
                return route('post.edit', $post->id);
            })
            ->addColumn('route_update_field', function ($post) {
                return route('post.update_field', $post->id);
            })
            ->addColumn('route_delete', function ($post) {
                return route('post.destroy', $post->id);
            })
            ->addColumn('route_view', function ($post) {
                return \Posts::makeUrl($post);
            })
            ->addColumn('move_up', function ($post) {
                return route('post.move', ['id' => $post->id, 'direction' => 'up']);
            })
            ->addColumn('move_down', function ($post) {
                return route('post.move', ['id' => $post->id, 'direction' => 'down']);
            })
            ->addColumn('move_top', function ($post) {
                return route('post.move', ['id' => $post->id, 'direction' => 'top']);
            })
            ->addColumn('move_bottom', function ($post) {
                return route('post.move', ['id' => $post->id, 'direction' => 'bottom']);
            })
            ->make(true);
    }

    public function createPost($data)
    {
        DB::beginTransaction();
        $seo = (new SEO())->createSEO($data);
        $content = (new Content())->createContent($data);
        $data['seo_id'] = $seo->id;
        $data['content_id'] = $content->id;
        $data['sort_order'] = $this->max('sort_order') + 1;
        $post = $this->create(array_only($data, $this->filter));
        DB::commit();
        return $post;
    }

    public function updatePost($data, $id)
    {
        $post = $this->with(['seo', 'content'])->find($id);
        if ($post) {
            DB::beginTransaction();
            $post->update(array_only($data, $this->filter));
            $post->seo->update(array_only($data, (new SEO())->filter));
            $post->content->update(array_only($data, (new Content())->filter));
            DB::commit();
        }

        return $post;

    }

    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }

    public function getInFrontend()
    {
        return $this->whereActive()->where('published_date', '<', Carbon::now());
    }

    public function getPostByCategoryIds($ids, $limit = 12)
    {
        return $this->getInFrontend()->sortOrder()->whereIn('cat_id', $ids)->paginate($limit);
    }

}
