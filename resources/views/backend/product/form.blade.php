<div class="row">
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-info-circle" aria-hidden="true"></i>

                <h3 class="box-title">Thông tin Sản phẩm</h3>
            </div>
            <div class="box-body">
                {{Form::cText('Tên sản phẩm', 'title', old('title')?old('title'):@$product['title'], ['required'=>true, 'placeholder'=>'Tiêu đề ...', 'id'=>'title'])}}

                {{Form::cText('Mã sản phẩm', 'code', old('code')?old('code'):@$product['code'], ['placeholder'=>'Mã sản phẩm ...'])}}
                <div class="row">
                    <div class="col-md-6">
                        {{Form::cText('Giá sản phẩm', 'price', old('price')?old('price'):(@$product['price']?$product['price']:0), ['class'=>'form-control price', 'placeholder'=>'Giá sản phẩm ...'])}}
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="price_promotion">Giá khuyến mãi</label>

                            <div class="col-sm-10 row">
                                <input class="form-control price" placeholder="Giá khuyến mãi ..."
                                       name="price_promotion" type="text" id="price_promotion"
                                       value="{{old('price_promotion')?old('price_promotion'):(@$product['price_promotion']?$product['price_promotion']:0)}}">
                                <div id="time_promotion_toggle"
                                     class="{{@$product['has_time_promotion']?'collapse in':'collapse'}}"
                                     style="margin-top: 5px">
                                    <label for="time_promotion">Thời gian</label>
                                    <input class="form-control daterange" id="time_promotion" placeholder="..."
                                           name="time_promotion" type="text" value="{{@$product['time_promotion']}}">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label for="has_time_promotion" data-target="#time_promotion_toggle"
                                       data-toggle="collapse"
                                       style="font-size: 24px"
                                       aria-expanded="{{@$product['has_time_promotion']?'false':'true'}}"><i
                                            class="fa fa-calendar-o"></i></label>
                                <input hidden type="checkbox" id="has_time_promotion" name="has_time_promotion"
                                       value="1" {{@$product['has_time_promotion']?'checked':''}}>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
                <h3 class="box-title">Thông tin hiển thị</h3>
            </div>
            <div class="box-body">
                {{Form::cText('Đường dẫn', 'slug', old('slug')?old('slug'):@$product['slug'], ['required'=>true, 'placeholder'=>'Đường dẫn thân thiện ...', 'id'=>'slug'])}}
                {{Form::cTextArea('Mô tả', 'description', old('description')?old('description'):@$product['description'])}}
                {{Form::cTextEditor('Nội dung', 'content', old('content')?old('content'):@$content['content'],'400px')}}
            </div>
        </div>

        {{Form::cSEO(@$seo)}}
    </div>

    <div class="col-md-3">
        <div class="box box-success">
            <div class="box-header with-border">
                <i class="fa fa-podcast" aria-hidden="true"></i>

                <h3 class="box-title">Tùy chọn</h3>
            </div>
            <div class="box-body">
                {{Form::cSwitch('Hiển thị', 'active', 1, old('active') ? true : (@$product['active'] ? true : false), ['data-on-color'=>"success", 'data-off-color'=>"danger", 'data-on-text'=>"Hiện", 'data-off-text'=>"Ẩn"])}}
                {{Form::cDateTime('Ngày xuất bản', 'published_date', old('published_date')?old('published_date'):@$product['published_date'])}}
                {{Form::cFileSingle('Ảnh đại diện (600x600)', 'thumb', old('thumb')?old('thumb'):@$product['thumb'], '', '180px')}}
                {{Form::cFileMulti('Gallery (600x600)', 'gallery', old('gallery')?old('gallery'):@$product['gallery'], '', '180px')}}
            </div>
        </div>

        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Phân loại</h3>

                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                {{ Form::cSelect('Danh mục','cat_id', [0 => 'Chưa phân loại']+\App\Models\Category::buildTree('product'), old('cat_id')?old('cat_id'):@$product['cat_id'], ['data-placeholder'=>'Chọn danh mục Sản phẩm']) }}
            </div>
        </div>
    </div>
    <div class="col-md-12 text-center">
        <a type="button" href="{{route('product.index')}}" class="btn btn-default">
            <i class="fa fa-undo" aria-hidden="true"></i> Quay lại</a>
        <button type="submit" class="btn btn-success">
            <i class="fa fa-cloud-upload" aria-hidden="true"></i> Hoàn thành
        </button>
    </div>
</div>