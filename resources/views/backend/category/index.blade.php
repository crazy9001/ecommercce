@extends('backend.layout.master')
@section('style')
    <style>
        /* Nestable */
        .dd {
            max-width: 100%;
        }

        .dd-handle {
            height: 40px;
            border-radius: 0px;
            padding: 10px 25px;
            font-weight: bold;
        }

        .dd-item > button {
            height: 30px;
            font-size: 20px;
        }
    </style>
@endsection

@section('script')
    <script>
        // activate Nestable
        $('#nestable_category').nestable();

        $('#update_category').click(function () {
            $(this).addClass('disabled');
            var categories = $('#nestable_category').nestable('serialize');
            $.each(categories, function (index, value) {
                if (value.children) {
                    addParent(categories, value.children, value.id);
                    value.children = undefined;
                }
            });
            var data = {categories: categories, _token: '{{ csrf_token() }}'};
            _ajax('{{route('post.category.sort')}}', 'POST', data);
            $('#update_category').removeClass('disabled');
        });

        function addParent(categories, value, parent) {
            $.each(value, function (index, value) {
                value.parent_id = parent;
                categories.push(value);
                if (value.children) {
                    addParent(categories, value.children, value.id);
                    value.children = undefined;
                }
            });
        }

        /*Xóa phần tử*/
        $(document).on('click', '.delete_element', function () {
            var data = $(this).data();
            var action = $(this).attr('action');
            data._token = _token;
            var $self = $(this);
            swal({
                    title: "Bạn có chắc xóa?",
                    text: "Bạn sẽ không khôi phục được dữ liệu này!",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Hủy",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Đồng ý",
                    closeOnConfirm: true
                },
                function () {
                    _ajax(action, 'DELETE', data);
                    $self.closest('.dd-item').remove();
                });
        });

    </script>
@endsection
@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Chỉnh sửa danh mục', 'breadcrumbs'=>[
        ['url'=>'/admin', 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['label'=>'Danh mục', 'icon'=>'<i class="fa fa-table"></i>'],
    ]])
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                    <h3 class="box-title">Tất cả các danh mục</h3>
                    <a href="{{route("$type.category.create")}}" style="width: 85px;float: right;" type="button"
                       class="btn btn-block btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Thêm</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <div class="dd" id="nestable_category">
                        <ol class="dd-list">
                            @foreach($categories->where('parent_id',0) as $category)
                                <li class="dd-item" data-id="{{$category->id}}">
                                    <div class="dd-handle">{{$category->title}}</div>
                                    <div style="position: absolute; top:7px;right: 10px;">
                                        <a class="btn btn-info btn-xs"
                                           href="{{route("$type.index")}}?cat_id={{$category->id}}"><i
                                                    class="fa fa-database" aria-hidden="true"></i></a>
                                        <a class="btn btn-default btn-xs"
                                           href="{{route("$type.category.edit",$category->id)}}"><i
                                                    class="fa fa-pencil-square-o"
                                                    aria-hidden="true"></i></a>
                                        <a class="btn btn-danger btn-xs delete_element"
                                           action="{{route("$type.category.destroy",$category->id)}}"><i
                                                    class="fa fa-fw fa-trash"></i></a>
                                    </div>
                                    @php($category_child = $categories->where('parent_id', $category->id))
                                    @if($category_child->count())
                                        @include('backend.category.child')
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-success pull-right" type="button" id="update_category">
                        <i class="fa fa-cloud-upload" aria-hidden="true"></i> Cập nhật
                    </button>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection