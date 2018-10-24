<?php
/**
 * Created by PhpStorm.
 * User: MINH
 * Date: 7/1/2017
 * Time: 9:53 PM
 */

use Illuminate\Support\Facades\Storage;

function urlFile($path)
{
    if (!$path) {
        return '/image/no_image.png';
    }
    return $path;
    //return Storage::url($path);
}

function updateViewCount($taxonomy)
{
    $taxonomy->view_count += 1;
    $taxonomy->save();
}


function formatPrice($price)
{
    return number_format($price, 0, ",", ".");
}

function getAvatar($image)
{
    if ($image) {
        return $image;
    }

    return asset('image/no_avatar.png');
}