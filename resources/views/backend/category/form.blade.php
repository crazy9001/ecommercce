<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
                <h3 class="box-title">Thông tin hiển thị</h3>
            </div>
            <!-- /.box-header -->
            <!-- /.box-header -->
            <div class="box-body">
                {{ Form::cText('Tiêu đề', 'title', old('title')?old('title'):@$category['title'], ['required'=>true, 'placeholder'=>'Tiêu đề ...', 'id'=>'title']) }}
                {{ Form::cText('Đường dẫn', 'slug', old('slug')?old('slug'):@$category['slug'], ['required'=>true, 'placeholder'=>'Đường dẫn thân thiện ...', 'id'=>'slug']) }}
                {{ Form::cTextArea('Mô tả', 'description', old('description')?old('description'):@$category['description']) }}
            </div>
        </div>

        {{ Form::cSEO(@$seo) }}
    </div>
    <div class="col-md-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <i class="fa fa-podcast" aria-hidden="true"></i>

                <h3 class="box-title">Các tùy chọn</h3>
            </div>
            <div class="box-body">
                {{ Form::cSelect('Danh mục cha','parent_id', [0=>'Danh mục gốc']+\App\Models\Category::buildTree($type, @$category->id), old('parent_id')?old('parent_id'):@$category['parent_id'], ['data-placeholder'=>'Chọn danh mục cha']) }}

                {{Form::cFileSingle('Ảnh đại diện (600x630)', 'thumb', old('thumb')?old('thumb'):@$category['thumb'], '', '200px')}}

                {{Form::cFileSingle('Icon (30x30)', 'icon', old('icon')?old('icon'):@$category['icon'], '', '50px')}}

                @if($type == 'product')
                    {{Form::cFileMulti('Banner (600x250)', 'gallery', old('gallery')?old('gallery'):@$category['gallery'], '', '50px')}}
                @endif

            </div>
        </div>
    </div>
</div>
<div class="row text-center">
    <a type="button" href="{{route("$type.category.index")}}" class="btn btn-default"><i class="fa fa-undo"
                                                                                         aria-hidden="true"></i>
        Quay lại</a>

    <button class="btn btn-success" type="submit">
        <i class="fa fa-cloud-upload" aria-hidden="true"></i> Cập nhật
    </button>
</div>