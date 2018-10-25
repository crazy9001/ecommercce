<?php

use App\Models\Category;
use App\Models\Page;

class Pages
{
    public static function count()
    {
        return Page::countPage();
    }

    public static function getAllPage($lang_code)
    {
        return Page::getAllPage($lang_code);
    }

    public static function urlPage($page)
    {
        try {
            return '/' . $page->slug . '/';
        } catch (Exception $e) {
            return route('error.404');
        }
    }
}
