<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 10/29/2018
 * Time: 9:53 AM
 */

namespace App\Http\Controllers\Backend\Widget;

use App\Http\Requests\WidgetRequest;
use App\Models\MostViewProductWidget;

class MostViewProductWidgetController extends WidgetController
{
    protected $type = 'most_view_product';

    public function store(WidgetRequest $request)
    {
        $data = $request->except('_token');
        $product_widget = (new MostViewProductWidget())->createMostViewProductWidget($data);
        if($product_widget)
        {
            return $this->response(route('widget.most_view_product.edit', ['id' => $product_widget->id]));
        }
        return $this->response(route('widget.most_view_product.create'));
    }

    public function update($id, WidgetRequest $request)
    {

        $data = $request->except(['_token', '_method']);
        $product_widget = (new MostViewProductWidget())->updateWidget($data, $id);
        return $this->response();
    }

    public function dataTable()
    {
        return MostViewProductWidget::dataTable();
    }

}