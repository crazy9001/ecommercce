@extends('backend.layout.master')

@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Quản lý Widget Sản phẩm', 'breadcrumbs'=>[
        ['url'=>'/admin', 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['label'=>'Bố cục website', 'icon'=>'<i class="fa fa-table"></i>'],
        ['label'=>'Widget Sản phẩm']
    ]])
@endsection

@section('script')
    @parent
    <script>
        var DataTable = new DataTableClass();
        var columns = [
            {
                title: 'Tên Widget Sản phẩm',
                name: 'title',
                data: null,
                render: function (data) {
                    return '<a href="' + data.route_edit + '">' + data.title + '</a>';
                },
                className: 'middle'
            },
            {
                title: '',
                data: null,
                render: function (data) {
                    return DataTable.showDeleteButton(data.route_delete);
                },
                orderable: false,
                searchable: false,
                className: 'dataTable_action text-center middle'
            },
        ];
        var option = {};
        DataTable.init('#widget_datatable', columns, option);

        function DataTableCallback() {
            DataTable.reload();
        }
    </script>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <i class="fa fa-info-circle" aria-hidden="true"></i>
            <h3 class="box-title">Tất cả các Widget Sản phẩm</h3>
            <a href="{{route('widget.product_widget.create')}}" style="width: 85px;float: right;" type="button"
               class="btn btn-block btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Thêm</a>
        </div>
        <div class="box-body">
            <table id="widget_datatable" class="table table-bordered table-striped"
                   action="{{route('widget.product_widget.datatable')}}">
            </table>
        </div>
    </div>
@endsection