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
            padding: 8px 25px;
            font-weight: bold;
        }

        .dd-item > button {
            height: 30px;
            font-size: 20px;
        }

        .dd-empty {
            display: none;
        }

    </style>
@endsection
@section('script')
    <script>
        $(document).on('keyup', 'input[name=title]', function () {
            $(this).parents('li:first').children('.dd-handle:first').html($(this).val());
        });

        // activate Nestable
        var old_data;
        $('#nestable').nestable({
            onDragStart: function (l, e, p) {
                old_data = $(l).nestable('toArray');
            },
            callback: function (l, e, p) {
                var new_data = $(l).nestable('toArray');
                if (JSON.stringify(old_data) !== JSON.stringify(new_data)) {
                    old_data = new_data;
                    $.ajax({
                        url: '{{route('menu.sort')}}',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: _token,
                            items: new_data
                        },
                        success: function (response) {
                            notifyAjax(response);
                        },
                        error: function () {
                            notifyAjax(response);
                        }
                    })
                }

            }
        });

        function addItemMenu(data) {
            data._token = _token;
            data.position = '{{@$_GET['position']}}';
            $.ajax({
                type: 'POST',
                url: '{{route('menu.store')}}',
                data: data,
                success: function (response) {
                    notifyAjax(response);
                    $('#nestable>ol.dd-list').append(response.html);
                }
            });
        }

        /*Xóa phần tử*/
        $(document).on('click', '.remove_menu_item', function () {
            var item = $(this).parents('li:first');
            var data = $(this).data();
            var action = $(this).attr('action');
            data._token = _token;
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
                    $.ajax({
                        type: 'DELETE',
                        url: action,
                        data: data,
                        success: function (response) {
                            notifyAjax(response);
                            item.remove();
                        }
                    });
                });
        });
        /*Them phần tử*/
        $(document).on('click', '.add-to-menu', function () {
            var data = $(this).data();
            addItemMenu(data);
        });

    </script>
@endsection
@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Menu', 'sub_title'=>'Quản lý và sắp xếp menu', 'breadcrumbs'=>[
        ['url'=>'/admin', 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['label'=>'Menu', 'icon'=>'<i class="fa fa-table"></i>']
    ]])
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Các thành phần MENU</h3>
                </div>
            </div>
            <div class="box collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title" data-widget="collapse">Trang</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body" style="max-height: 200px;overflow: auto;">
                    <div class="form-group">
                        <div class="form-group">
                            <a style="line-height: 0.5;">
                                Trang chủ
                                <button class="add-to-menu" style="float: right" data-title="Trang chủ"
                                        data-type="homepage" data-type_id=""><i class="fa fa-chevron-right"
                                                                                aria-hidden="true"></i></button>
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <a style="line-height: 0.5;">
                                Liên hệ
                                <button class="add-to-menu" style="float: right" data-title="Liên hệ"
                                        data-type="contact" data-type_id=""><i class="fa fa-chevron-right"
                                                                               aria-hidden="true"></i></button>
                            </a>
                        </div>
                    </div>
                    @php($pages = \App\Models\Page::getPageInMenu())
                    @foreach($pages as $page)
                        <div class="form-group">
                            <a style="line-height: 0.5;">
                                {{$page->title}}
                                <button class="add-to-menu" style="float: right" data-title="{{$page->title}}"
                                        data-type="page" data-type_id="{{$page->id}}"><i class="fa fa-chevron-right"
                                                                                         aria-hidden="true"></i>
                                </button>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="box collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title" data-widget="collapse">Danh mục Bài viết</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body" style="max-height: 200px;overflow: auto;">
                    <div class="form-group">
                        <div class="form-group">
                            <a style="line-height: 0.5;">
                                Tất cả tin tức
                                <button class="add-to-menu" style="float: right" data-title="Tất cả tin tức"
                                        data-type="fpost" data-type_id=""><i class="fa fa-chevron-right"
                                                                             aria-hidden="true"></i></button>
                            </a>
                        </div>
                    </div>
                    @php($postCategories = \App\Models\PostCategory::getCategory())
                    @foreach($postCategories as $category)
                        <div class="form-group">
                            <a style="line-height: 0.5;">
                                {{$category->title_tree}}
                                <button class="add-to-menu" style="float: right" data-title="{{$category->title}}"
                                        data-type="post" data-type_id="{{$category->id}}"><i class="fa fa-chevron-right"
                                                                                             aria-hidden="true"></i>
                                </button>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="box collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title" data-widget="collapse">Danh mục Sản phẩm</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body" style="max-height: 200px;overflow: auto;">
                    <div class="form-group">
                        <div class="form-group">
                            <a style="line-height: 0.5;">
                                Tất cả sản phẩm
                                <button class="add-to-menu" style="float: right" data-title="Tất cả sản phẩm"
                                        data-type="fproduct" data-type_id=""><i class="fa fa-chevron-right"
                                                                                aria-hidden="true"></i></button>
                            </a>
                        </div>
                    </div>
                    @php($productCategories = \App\Models\ProductCategory::getCategory())
                    @foreach($productCategories as $category)
                        <div class="form-group">
                            <a style="line-height: 0.5;">
                                {{$category->title_tree}}
                                <button class="add-to-menu" style="float: right" data-title="{{$category->title}}"
                                        data-type="product" data-type_id="{{$category->id}}"><i
                                            class="fa fa-chevron-right"
                                            aria-hidden="true"></i>
                                </button>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="box collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title" data-widget="collapse">Liên kết ngoài</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="menu_name">Tên Menu</label>
                        <input type="text" class="form-control" id="menu_name" placeholder="Tên Menu">
                    </div>
                    <div class="form-group">
                        <label for="menu_link">Link liên kết</label>
                        <input type="text" class="form-control" id="menu_link" placeholder="http://">
                    </div>
                    <div class="form-group">
                        <input type="checkbox" c-type="icheck" id="newtab">
                        <label> Mở tab mới </label>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-right">
                    <button class="btn btn-default" id="btn_menu_link">Thêm menu</button>
                    <script>
                        $(document).on('click', '#btn_menu_link', function () {
                            var data = {
                                title: $('#menu_name').val(),
                                type: 'link',
                                link: $('#menu_link').val(),
                                new_tab: $('input#newtab').is(':checked') ? 1 : 0
                            };
                            if ($('#menu_name').val() == '') {
                                $('#menu_name').parent().addClass('has-error');
                                return false;
                            } else {
                                $('#menu_name').parent().removeClass('has-error');
                            }
                            $('#menu_link').val('');
                            $('#menu_name').val('');
                            addItemMenu(data);
                        });
                    </script>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <i class="ion ion-clipboard"></i>
                    <h3 class="box-title">Sắp xếp MENU</h3>
                </div>
                <div class="box-body" id="menu_nestable">
                    {{--<div class="dd" id="nestable">--}}
                    <div class="dd" id="nestable">
                        <ol class="dd-list">
                            @foreach($menus->where('parent_id',0) as $menu)
                                <li class="dd-item" data-id="{{$menu->id}}">
                                    {{Form::cMenuItem($menu)}}
                                    @php($menu_child = $menus->where('parent_id', $menu->id))
                                    @if(count($menu_child))
                                        @include('backend.menu.child')
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection