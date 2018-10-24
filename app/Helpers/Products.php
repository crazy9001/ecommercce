<?php

/*
* Helper class for Category
*/

use App\Models\ProductCategory;
use App\Models\Product;

class Products
{
    /*Tạo link cho danh sách bài viết*/
    public static function makeUrl($product)
    {
        if ($product->category) {
            $product->url = '/' . $product->category->slug . '/' . $product->slug . '.html';
        } else {
            $product->url = '/product/' . $product->slug . '.html';
        }

        return $product->url;
    }

    /*Lấy danh sách Sản phẩm của danh mục*/
    public static function getProductsByCategory($cat_id, $limit = 12)
    {
        $cat_ids = array_merge_recursive([$cat_id], ProductCategory::getAllChildren([$cat_id]));
        if (count($cat_ids)) {
            $products = (new Product())->getProductByCategoryIds($cat_ids, $limit);
            foreach ($products as $product) {
                self::makeUrl($product);
            }
            return $products;
        }
        return [];
    }

    /*Lấy danh sách Sản phẩm của danh mục*/
    public static function getProductsManySearches($limit = 5)
    {
        $products = (new Product())->getInFrontend()->orderBy('view_count', 'desc')->sortOrder()->paginate($limit);
        foreach ($products as $product) {
            self::makeUrl($product);
        }
        return $products;
    }

    /*Lấy danh sách Sản phẩm liên quan*/
    public static function getProductsRelated($product, $limit = 5)
    {
        $cat_ids = array_merge_recursive([$product->cat_id], ProductCategory::getAllChildren([$product->cat_id]));
        if (count($cat_ids)) {
            $products = (new Product())->whereIn('cat_id', $cat_ids)->where('id', '<>', $product->id)->inRandomOrder()->paginate($limit);
            foreach ($products as $product) {
                self::makeUrl($product);
            }
            return $products;
        }
        return [];
    }

    /*Lấy danh sách Sản phẩm mới nhất*/
    public static function getProductsLatest($limit = 12)
    {
        $products = (new Product())->getInFrontend()->orderBy('published_date', 'desc')->sortOrder()->paginate($limit);
        foreach ($products as $product) {
            self::makeUrl($product);
        }
        return $products;
    }

    public static function getProductsSearch($data, $limit = 12)
    {
        $products = (new Product())->getInFrontend()->sortOrder();
        if (@$data['keyword']) {
            $products = $products->where('title', 'like', "%" . $data['keyword'] . "%");
        }
        $products = $products->paginate($limit);
        foreach ($products as $product) {
            self::makeUrl($product);
        }
        return $products;
    }


}

