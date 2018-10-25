<?php

/*
* Helper class for Menu
*/

use App\Models\Menu;

class Menus
{
    public static function makeMenu($item)
    {
        try {
            switch ($item['type']) {
                case 'homepage':
                    $item->url = route('home');
                    break;
                case 'contact':
                    $item->url = route('fcontact') . '/';
                    break;
                case 'fpost':
                    $item->url = route('fpost') . '/';
                    break;
                case 'fproduct':
                    $item->url = route('fproduct') . '/';
                    break;
                case 'post':
                case 'product':
                case 'page':
                    $item->url = Categories::makeUrl($item->category);
                    break;
                case 'link':
                    $item->url = $item->link;
                    break;
            }
        } catch (\Exception $e) {
            $item->url = route('error.404');
        }

    }

    /*Lấy danh sách menu*/
    public static function getMenus($position = 'primary')
    {
        $menus = Menu::with('category')->where('position', $position)->orderBy('sort_order')->get();

        foreach ($menus as $item) {
            self::makeMenu($item);
        }
        return $menus;
    }

}
