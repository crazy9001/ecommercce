<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 10/24/2018
 * Time: 11:30 AM
 */

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests\CategoryRequest;

class CategoryController extends BackendController
{
    public $type = 'post';

    public function __construct()
    {
        parent::__construct();
        view()->share('type', $this->type);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::where('type', $this->type)
            ->orderBy('sort_order')->get();
        return view('backend.category.index')
            ->with('categories', $categories);
    }

    public function create(){
        return view('backend.category.create');
    }

    /**
     * Sort categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function sort(Request $request)
    {

        try {
            $categories = $request->categories;
            DB::beginTransaction();
            foreach ($categories as $index => $category) {
                $cat = Category::find($category['id']);
                if (isset($category['parent_id'])) {
                    $cat->parent_id = $category['parent_id'];
                } else {
                    $cat->parent_id = 0;
                }
                $cat->sort_order = $index;
                $cat->save();
            }
            DB::commit();
            $response = ['code' => 1, 'msg' => 'Lưu thành công!'];
            return $response;
        } catch (\Exception $e) {
            $response = ['code' => 0, 'msg' => 'Lưu thất bại! Vui lòng tải lại trang'];
            return $response;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request){
        $data = $request->except('_token');
        $data['type'] = $this->type;
        (new Category())->createCategory($data);
        return $this->response(route("$this->type.category.index"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $category = Category::with('seo')->find($id);
        if(!$category) return redirect(route("$this->type.category.index"));
        view()->share('category',$category);
        $seo = $category->seo;
        view()->share('seo',$seo);

        return view('backend.category.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id, CategoryRequest $request){

        $data = $request->except(['_token', '_method']);

        $categoryModel = new Category();
        $categoryModel->updateCategory($data, $id);

        return $this->response();

    }

    /**
     * @param $id
     * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($id){

        Category::find($id)->delete();
        return $this->response();
    }
}