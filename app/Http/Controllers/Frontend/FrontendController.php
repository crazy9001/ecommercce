<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 10/26/2018
 * Time: 11:08 AM
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Facuz\Theme\Facades\Theme;
use Illuminate\View\View;

class FrontendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $breadcrumbs = [];

    public function __construct(Request $request)
    {
        $configs = Setting::all()->pluck('value', 'key')->toArray();
        config(['setting' => $configs]);
        $this->setSEO(config('setting.seo'));
    }

    public function setSEO($seo)
    {
        Theme::set('title', @$seo['seo_title']);
        Theme::set('description', @$seo['seo_description']);
        Theme::set('keywords', @$seo['seo_keywords']);
        Theme::set('robots', @$seo['robots'] ? 'index,follow' : 'noindex,nofollow');
    }

    public function setBreadcrumb($category)
    {
        $this->addBreadcrumb($category);
        view()->share('breadcrumbs', $this->breadcrumbs);
    }

    protected function addBreadcrumb($category)
    {
        $crumb = [
            'label' => 'Trang chủ',
            'url' => '/'
        ];
        if ($category) {
            $crumb = [
                'label' => $category['title'],
                'url' => '/' . $category['slug'] . '/'
            ];
            $this->addBreadcrumb($category->parent);
        }

        array_push($this->breadcrumbs, $crumb);
    }
}