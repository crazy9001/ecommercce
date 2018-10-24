@extends('backend.layout.master')
@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Quản lý Sản phẩm', 'breadcrumbs'=>[
        ['url'=>'/admin', 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['label'=>'Sản phẩm', 'icon'=>'<i class="fa fa-table"></i>']
    ]])
@endsection

@section('script')
    @parent
    <script>
        var DataTable = new DataTableClass();
        var columns = [
            {
                title: 'Ảnh',
                data: null,
                render: function (data) {
                    return '<img src="' + data.thumb + '" width="50" height="50">';
                },
                searchable: false,
                className: 'text-center'
            },
            {
                title: 'Tên sản phẩm',
                name: 'title',
                data: null,
                render: function (data) {
                    return '<a href="' + data.route_edit + '">' + data.title + '</a>';
                }
            },
            {
                title: 'Danh mục',
                data: null,
                searchable: false,
                render: function (data) {
                    return data.category ? data.category.title : '';
                }
            },
            {
                title: 'Sắp xếp',
                data: null,
                render: function (data) {
                    return DataTable.showMove(data);
                },
                searchable: false,
                className: 'text-center'
            },
            {
                title: '',
                data: null,
                render: function (data) {
                    return DataTable.showCopyButton('{{route('product.create')}}?id=' + data.id) + DataTable.showActiveButton(data) + DataTable.showViewButton(data.route_view) + DataTable.showDeleteButton(data.route_delete);
                },
                searchable: false,
                className: 'dataTable_action text-center'
            }
        ];
        var option = {};
        DataTable.init('#product_datatable', columns, option);

        function DataTableCallback() {
            DataTable.reload();
        }
    </script>
@endsection

@section('content')
    <div class="row">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Danh sách Sản phẩm</h3>
                <a href="{{route('product.create')}}" style="width: 85px;float: right;" type="button"
                   class="btn btn-block btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Thêm</a>
            </div>
            <div class="box-body">
                <table id="product_datatable" class="table table-bordered table-striped"
                       action="{{route('product.datatable', request()->all())}}">
                </table>
            </div>
        </div>
    </div>
@endsection