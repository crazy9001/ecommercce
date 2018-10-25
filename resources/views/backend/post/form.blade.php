<div class="row">
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
                <h3 class="box-title">Thông tin hiển thị</h3>
            </div>
            <div class="box-body">
                {{Form::cText('Tiêu đề', 'title', old('title')?old('title'):@$post['title'], ['required'=>true, 'placeholder'=>'Tiêu đề ...', 'id'=>'title'])}}
                {{Form::cText('Đường dẫn', 'slug', old('slug')?old('slug'):@$post['slug'], ['required'=>true, 'placeholder'=>'Đường dẫn thân thiện ...', 'id'=>'slug'])}}
                {{Form::cTextArea('Mô tả', 'description', old('description')?old('description'):@$post['description'])}}
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
            <!-- /.box-header -->
            <div class="box-body">
                {{Form::cSwitch('Hiển thị', 'active', 1, old('active') ? true : (@$post['active'] ? true : false), ['data-on-color'=>"success", 'data-off-color'=>"danger", 'data-on-text'=>"Hiện", 'data-off-text'=>"Ẩn"])}}
                {{Form::cDateTime('Ngày xuất bản', 'published_date', old('published_date')?old('published_date'):@$post['published_date'])}}
                {{Form::cFileSingle('Ảnh đại diện (600x400)', 'thumb', old('thumb')?old('thumb'):@$post['thumb'], '', '180px')}}
            </div>
            <!-- /.box-body -->
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
                {{ Form::cSelect('Danh mục','cat_id', [0 => 'Chưa phân loại']+\App\Models\Category::buildTree('post'), old('cat_id')?old('cat_id'):@$post['cat_id'], ['data-placeholder'=>'Chọn danh mục bài viết']) }}
            </div>
        </div>
    </div>
    <div class="col-md-12 text-center">
        <a type="button" href="{{route('post.index')}}" class="btn btn-default"><i class="fa fa-undo"
                                                                                   aria-hidden="true"></i> Quay lại</a>
        <button type="submit" class="btn btn-success">
            <i class="fa fa-cloud-upload" aria-hidden="true"></i> Hoàn thành
        </button>
    </div>
</div>