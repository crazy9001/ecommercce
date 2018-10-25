<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 10/25/2018
 * Time: 1:31 PM
 */

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;

class MenuController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $position = $request->has('position') ? $request->position : 'primary';
        $menus = Menu::where('position', $position)->orderBy('sort_order')->get();
        return view('backend.menu.index')->with('menus', $menus);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        if (!@$data['position']) {
            $data['position'] = 'primary';
        }
        $data['sort_order'] = Menu::max('sort_order')??0;
        $data['sort_order'] += 1;

        $item = (new Menu())->createMenu($data);

        $html = '<li class="dd-item" data-id="' . $item->id . '">'
            . preg_replace('~[\r\n]+~', '', \Form::cMenuItem($item))
            . '</li>';

        return $this->response(null, ['html' => $html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', '_method']);

        $item = (new Menu())->updateMenu($data, $id);

        return $this->response();
    }

    public function sort(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data['items'] as $index => $item) {
            $update = ['sort_order' => $index];
            $update['parent_id'] = isset($item['parent_id']) ? $item['parent_id'] : 0;
            Menu::find($item['id'])->update($update);
        }
        return [
            'code' => 1,
            'msg' => 'Cập nhật thành công!',
        ];
    }

    /**
     * @param $id
     * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ids = array_merge_recursive([$id], Menu::getListIdMenuChild([$id]));
        foreach ($ids as $id) {
            if ($item = Menu::find($id)) {
                $item->delete();
            }
        }
        return $this->response();
    }
}