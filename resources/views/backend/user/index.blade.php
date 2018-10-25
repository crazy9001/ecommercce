@extends('backend.layout.master')

@section('script')
    <script>
        var DataTable = new DataTableClass();
        var columns = [
            {
                title: 'Họ tên',
                name: 'name',
                data: null,
                render: function (data) {
                    return '<a href="' + data.route_show + '">' + data.name + '</a>';
                },
                className: 'dataTable_name'
            },
            {
                title: 'Email',
                name: 'email',
                data: 'email',
                className: 'dataTable_email'
            },
            {
                title: 'Số điện thoại',
                name: 'phone',
                data: 'phone',
                className: 'dataTable_email'
            },
            {
                title: '',
                data: null,
                render: function (data) {
                    return DataTable.showDeleteButton(data.route_delete);
                },
                orderable: false,
                searchable: false,
                className: 'dataTable_action text-center'
            },
        ];
        var option = {};
        DataTable.init('#table_contact', columns, option);

        function DataTableCallback() {
            DataTable.reload();
        }
    </script>
@endsection
@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'User', 'breadcrumbs'=>[
        ['url'=>route('admin'), 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['label'=>'User', 'icon'=>'<i class="fa fa-user"></i>']
    ]])
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách thành viên</h3>
                </div>
                <div class="box-body">
                    <table id="table_contact" class="table table-bordered table-striped"
                           action="{{route('user.datatable')}}">
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
@endsection
