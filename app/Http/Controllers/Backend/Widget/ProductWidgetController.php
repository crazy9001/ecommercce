<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 10/26/2018
 * Time: 4:29 PM
 */

namespace App\Http\Controllers\Backend\Widget;

use App\Http\Requests\WidgetRequest;
use App\Models\ProductWidget;

class ProductWidgetController extends WidgetController
{
    protected $type = 'product_widget';

    public function store(WidgetRequest $request)
    {
        $data = $request->except('_token');
        $product_widget = (new ProductWidget())->createProductWidget($data);
        return $this->response(route('widget.product_widget.edit', ['id' => $product_widget->id]));
    }

    public function update($id, WidgetRequest $request)
    {
        $data = $request->except(['_token', '_method']);
        $product_widget = (new ProductWidget())->updateWidget($data, $id);
        return $this->response();
    }


    public function dataTable()
    {
        return ProductWidget::dataTable();
    }

}