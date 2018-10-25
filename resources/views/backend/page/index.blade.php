@extends('backend.layout.master')

@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Quản lý trang', 'breadcrumbs'=>[
        ['url'=>'/admin', 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['label'=>'Trang', 'icon'=>'<i class="fa fa-table"></i>']
    ]])
@endsection
@section('script')
    @parent
    <script>
        var DataTable = new DataTableClass();
        var columns = [
            {
                title: 'Tiêu đề trang',
                name: 'title',
                data: null,
                render: function (data) {
                    return '<a href="' + data.route_edit + '">' + data.title + '</a>';
                }
            },
            {
                title: '',
                data: null,
                render: function (data) {
                    return DataTable.showViewButton(data.route_view) + DataTable.showDeleteButton(data.route_delete);
                },
                orderable: false,
                searchable: false,
                className: 'dataTable_action text-center'
            },
        ];
        var option = {};
        DataTable.init('#page_datatable', columns, option);

        function DataTableCallback() {
            DataTable.reload();
        }
    </script>
@endsection

@section('content')
    <div class="row">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Danh sách trang</h3>
                <a href="{{route('page.create')}}" style="width: 85px;float: right;" type="button"
                   class="btn btn-block btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Thêm</a>
            </div>
            <div class="box-body">
                <table id="page_datatable" class="table table-bordered table-striped"
                       action="{{route('page.datatable')}}">
                </table>
            </div>
        </div>
    </div>
@endsection