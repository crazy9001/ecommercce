<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Backend\BackendController;
use App\Models\Setting;
use File;
use Illuminate\Http\Request;
use Spatie\Sitemap\SitemapGenerator;

class SitemapController extends BackendController
{
    public function index()
    {
        try {
            $sitemap = file_get_contents(public_path("sitemap.xml"));
        } catch (\Exception $e) {
            $sitemap = null;
        }
        return view('backend.setting.sitemap.index')->with('sitemap', $sitemap);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('sitemap_file')) {
            $request->file('sitemap_file')->move(public_path(), "sitemap.xml");
        } else {
            $myfile = fopen(public_path("sitemap.xml"), "w");
            fwrite($myfile, $request->sitemap);
            fclose($myfile);
        }

        return $response = [
            'code' => 1,
            'msg' => 'Cập nhật thành công!',
        ];

    }

    public function generate(Request $request)
    {
        SitemapGenerator::create(url('/'))->writeToFile(public_path("sitemap.xml"));
        session()->flash('success', 'Cập nhật thành công!');
        return back();
    }


}
