<div class="box box-primary">
    <div class="box-header with-border">
        <i class="fa fa-info-circle" aria-hidden="true"></i>

        <h3 class="box-title">Thông tin Widget Sản phẩm</h3>
    </div>

    <div class="box-body">
        {{Form::cText('Tên Widget xem nhiều', 'title', old('title')?old('title'):@$product_widget->title, ['required'=>true, 'placeholder'=>'Tiêu đề ...'])}}

        {{Form::cSwitch('Hiển thị', 'active', 1, old('active') ? old('active') : @$product_widget->active, ['data-on-color'=>"success", 'data-off-color'=>"danger", 'data-on-text'=>"Hiện", 'data-off-text'=>"Ẩn"])}}

        <div class="form-group text-center">
            <button class="btn btn-success" type="submit">
                <i class="fa fa-cloud-upload" aria-hidden="true"></i> Hoàn thành
            </button>
        </div>
    </div>
</div>
