<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 10/29/2018
 * Time: 3:29 PM
 */

namespace App\Http\Controllers\Backend\Widget;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;

class SliderController extends WidgetController
{

    protected $type = 'slider';

    public function store(SliderRequest $request)
    {
        $data = $request->except('_token');
        $slider = (new Slider())->createSlider($data);
        return $this->response(route('widget.slider.edit', ['id' => $slider->id]));
    }

    public function update($id, SliderRequest $request)
    {
        $data = $request->except(['_token', '_method']);
        $slider = (new Slider())->updateWidget($data, $id);
        return $this->response();
    }

    public function dataTable()
    {
        return Slider::dataTable();
    }
}