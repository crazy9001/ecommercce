<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class Product extends BaseModel
{
    protected $table = 'product';
    protected $guarded = [];

    public $filter = ['code', 'title', 'description', 'slug', 'thumb', 'gallery', 'content_id', 'seo_id', 'cat_id', 'active', 'sort_order', 'published_date', 'start_promotion', 'stop_promotion', 'price', 'price_promotion'];


    public function category()
    {
        return $this->hasOne('App\Models\ProductCategory', 'id', 'cat_id');
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
            $cat_ids = array_merge_recursive([$cat_id], ProductCategory::getAllChildren([$cat_id]));
            $model = $model->whereIn('cat_id', $cat_ids);
        }

        return DataTables::of($model)
            ->addColumn('route_edit', function ($product) {
                return route('product.edit', $product->id);
            })
            ->addColumn('route_update_field', function ($product) {
                return route('product.update_field', $product->id);
            })
            ->addColumn('route_delete', function ($product) {
                return route('product.destroy', $product->id);
            })
            ->addColumn('route_view', function ($product) {
                return \Products::makeUrl($product);
            })
            ->addColumn('move_up', function ($product) {
                return route('product.move', ['id' => $product->id, 'direction' => 'up']);
            })
            ->addColumn('move_down', function ($product) {
                return route('product.move', ['id' => $product->id, 'direction' => 'down']);
            })
            ->addColumn('move_top', function ($product) {
                return route('product.move', ['id' => $product->id, 'direction' => 'top']);
            })
            ->addColumn('move_bottom', function ($product) {
                return route('product.move', ['id' => $product->id, 'direction' => 'bottom']);
            })
            ->make(true);
    }

    public function createProduct($data)
    {
        DB::beginTransaction();
        $seo = (new SEO())->createSEO($data);
        $content = (new Content())->createContent($data);
        $data['seo_id'] = $seo->id;
        $data['content_id'] = $content->id;
        $data['sort_order'] = $this->max('sort_order') + 1;
        $product = $this->create(array_only($data, $this->filter));
        DB::commit();
        return $product;
    }

    public function updateProduct($data, $id)
    {
        $product = $this->with(['seo', 'content'])->find($id);
        if ($product) {
            DB::beginTransaction();
            $product->update(array_only($data, $this->filter));
            $product->seo->update(array_only($data, (new SEO())->filter));
            $product->content->update(array_only($data, (new Content())->filter));
            DB::commit();
        }

        return $product;

    }

    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }

    public function getInFrontend()
    {
        return $this->with('category')->whereActive()->where('published_date', '<', Carbon::now());
    }

    public function getProductByCategoryIds($ids, $limit = 12)
    {
        return $this->getInFrontend()->sortOrder()->whereIn('cat_id', $ids)->paginate($limit);
    }

}
