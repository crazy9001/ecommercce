<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 10/25/2018
 * Time: 10:41 AM
 */

namespace App\Http\Controllers\Backend;

use App\Http\Requests\PageRequest;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends BackendController
{
    public function index()
    {
        return view('backend.page.index');
    }

    public function dataTable()
    {
        return Page::dataTable();
    }


    public function create(Request $request)
    {
        return view('backend.page.create');
    }

    public function store(PageRequest $request)
    {
        $data = $request->except('_token');

        $pageModel = new Page();

        $page = $pageModel->createPage($data);

        session()->flash('success', 'Cập nhật thành công!');
        return redirect()->route('page.edit', ['id' => $page->id]);
    }

    public function edit($id, Request $request)
    {
        $page = Page::find($id);
        if ($page) {
            view()->share('page', $page);
            $seo = $page->seo;
            view()->share('seo', $seo);
            $content = $page->content;
            view()->share('content', $content);
        }

        return view('backend.page.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id, PageRequest $request)
    {
        $data = $request->except(['_token', '_method']);

        $pageModel = new Page();
        $pageModel->updatePage($data, $id);

        return $this->response();
    }

    public function destroy($id)
    {
        Page::find($id)->delete();
        return $this->response(null, ['datatable' => true]);
    }
}