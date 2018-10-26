<?php

namespace App\Http\Controllers\Backend\Widget;

use App\Http\Controllers\Backend\BackendController;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Widget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class WidgetController extends BackendController
{
    protected $type = 'widget';

    function __construct()
    {
        parent::__construct();
        view()->share('type', $this->type);
    }

    public function index(Request $request)
    {
        return view("backend.widget.$this->type.index");
    }

    public function create(Request $request)
    {
        return view("backend.widget.$this->type.create");
    }

    public function edit($id)
    {
        $widget = Widget::find($id);
        return view("backend.widget.$this->type.edit")->with('widget', $widget);
    }

    public function destroy($id)
    {
        Widget::find($id)->delete();
        return $this->response(null, ['datatable' => true]);
    }
}
