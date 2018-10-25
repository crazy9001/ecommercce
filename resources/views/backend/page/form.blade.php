<div class="row">
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-info-circle" aria-hidden="true"></i>

                <h3 class="box-title">Thông tin hiển thị</h3>
            </div>
            <div class="box-body">
                {{Form::cText('Tiêu đề', 'title', old('title')?old('title'):@$page['title'], ['required'=>true, 'placeholder'=>'Tiêu đề ...', 'id'=>'title'])}}
                {{Form::cText('Đường dẫn', 'slug', old('slug')?old('slug'):@$page['slug'], ['required'=>true, 'placeholder'=>'Đường dẫn thân thiện ...', 'id'=>'slug'])}}
                {{Form::cTextArea('Mô tả', 'description', old('description')?old('description'):@$page['description'])}}
                {{Form::cTextEditor('Nội dung', 'content', old('content')?old('content'):@$content['content'],'400px')}}
            </div>
        </div>

        {{ Form::cSEO(@$seo) }}

    </div>
    <!-- /.col -->

    <div class="col-md-3">
        <div class="box box-success">
            <div class="box-header with-border">
                <i class="fa fa-podcast" aria-hidden="true"></i>

                <h3 class="box-title">Tùy chọn</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {{Form::cFileSingle('Ảnh đại diện', 'thumb', old('thumb')?old('thumb'):@$page['thumb'], '', '200px')}}
                {{Form::cFileSingle('Icon', 'icon', old('icon')?old('icon'):@$page['icon'], '', '50px')}}
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <!-- /.col -->
    <div class="col-md-12 text-center">
        <a type="button" href="{{route('page.index')}}" class="btn btn-default"><i class="fa fa-undo"
                                                                                   aria-hidden="true"></i> Quay lại</a>
        <button type="submit" class="btn btn-success">
            <i class="fa fa-cloud-upload" aria-hidden="true"></i> Hoàn thành
        </button>
    </div>
</div>