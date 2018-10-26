<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 10/24/2018
 * Time: 10:18 AM
 */

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Content;
use App\Models\Post;
use App\Models\Product;
use Facuz\Theme\Facades\Theme;
use Illuminate\Http\Request;
use App\Models\SEO;;

class IndexController extends FrontendController
{
    public function index(Request $request)
    {
        if (config('setting.status') == 0) {
            return abort(500);
        }
        $segments = $request->segments();

        if (!count($segments)) {
            return Theme::view('index');
        }

    }
}