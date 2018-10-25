<?php

/*
* Helper class for Category
*/

use App\Models\Video;
use App\Models\Post;
use App\Models\PostCategory;

class Posts
{
    /*Tạo link cho danh sách bài viết*/
    public static function makeUrl($post)
    {
        if ($post->category) {
            $post->url = '/' . $post->category->slug . '/' . $post->slug . '.html';
        } else {
            $post->url = '/post/' . $post->slug . '.html';
        }

        return $post->url;
    }

    /*Format Ngày tháng*/
    public static function makeDate($post)
    {
        $datetime = new \Carbon\Carbon($post->published_date);
        $post->time = $datetime->format('d/m/Y h:i A');
        return $post->time;
    }

    /*Lấy danh sách Bài viết Nổi bật*/
    public static function getPostFeatured($limit = 3)
    {
        $postModel = new Post();
        $posts = $postModel->getInFrontend()->sortOrder()->paginate($limit);
        foreach ($posts as $post) {
            self::makeUrl($post);
            self::makeDate($post);
        }
        return $posts;
    }

    /*Lấy danh sách Bài viết liên quan*/
    public static function getPostsRelated($post, $limit = 6)
    {
        $cat_ids = array_merge_recursive([$post->cat_id], PostCategory::getAllChildren([$post->cat_id]));
        $postModel = new Post();
        $posts = $postModel->getInFrontend()->whereIn('cat_id', $cat_ids)->where('id', '<>', $post->id)->inRandomOrder()->paginate($limit);
        foreach ($posts as $post) {
            self::makeUrl($post);
            self::makeDate($post);
        }
        return $posts;
    }

    /*Lấy danh sách Bài viết của danh mục*/
    public static function getPostsByCategory($cat_id, $limit = 12)
    {
        $cat_ids = array_merge_recursive([$cat_id], PostCategory::getAllChildren([$cat_id]));
        if (count($cat_ids)) {
            $posts = (new Post())->getPostByCategoryIds($cat_ids, $limit);
            foreach ($posts as $post) {
                self::makeUrl($post);
            }
            return $posts;
        }
        return [];
    }


    /*Tạo link cho danh sách bài viết*/
    public static function makeUrlYoutube($video)
    {
        $data = explode("?v=", $video->link);

        $video->url = "https://www.youtube.com/embed/" . @preg_replace('/&/', '?', $data[1], 1);;

        return $video->url;
    }

    /*Lấy danh sách Video của danh mục*/
    public static function getVideosByCategory($cat_id, $limit = 4)
    {
        $cat_ids = array_merge_recursive([$cat_id], PostCategory::getAllChildren([$cat_id]));
        if (count($cat_ids)) {
            $videos = (new Video())->getVideoByCategoryIds($cat_ids, $limit);
            foreach ($videos as $video) {
                self::makeUrlYoutube($video);
            }
            return $videos;
        }
        return [];
    }

    public static function getVideosLatest($limit = 4)
    {
        $videos = (new Video())->getInFrontend()->orderBy('published_date', 'desc')->sortOrder()->paginate($limit);
        foreach ($videos as $video) {
            self::makeUrlYoutube($video);
        }
        return $videos;
    }

    /*Lấy danh sách Bài viết mới nhất*/
    public static function getPostsLatest($limit = 12)
    {
        $postModel = new Post();
        $posts = $postModel->getInFrontend()->orderBy('published_date', 'desc')->sortOrder()->paginate($limit);
        foreach ($posts as $post) {
            self::makeUrl($post);
            self::makeDate($post);
        }
        return $posts;
    }


}

