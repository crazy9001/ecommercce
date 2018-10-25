@extends('backend.layout.master')
@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Quản lý Đơn hàng', 'breadcrumbs'=>[
        ['url'=>'/admin', 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['label'=>'Đơn hàng', 'icon'=>'<i class="fa fa-table"></i>']
    ]])
@endsection

@section('style')
    @parent
    <style>
        .order_code {
            width: 100px;
        }
    </style>
@endsection
@section('script')
    @parent
    <script>
        var DataTable = new DataTableClass();
        var columns = [
            {
                title: '#',
                name: 'code',
                data: null,
                render: function (data) {
                    return '<a href="' + data.route_show + '">' + data.code + '</a>';
                },
                className: 'order_code'
            },
            {
                title: 'Khách hàng',
                name: 'name',
                data: 'name'
            },
            {
                title: 'Trạng thái',
                data: null,
                render: function (data) {
                    var color = 'red';
                    switch (data.status) {
                        case 'Đơn hàng mới':
                            color = 'bg-teal disabled color-palette';
                            break;
                        case 'Đang xử lý':
                            color = 'bg-purple disabled color-palette';
                            break;
                        case 'Đang vận chuyển':
                            color = 'bg-gray color-palette';
                            break;
                        case 'Hoàn tất':
                            color = 'bg-green-active color-palette';
                            break;
                        case 'Đơn hàng đã hủy':
                            color = 'bg-red-active color-palette';
                            break;

                    }
                    return '<lable class="label ' + color + '">' + data.status + '</lable>';
                },
            },
            {
                title: 'Thời gian',
                data: 'created_at'
            }
        ];
        var option = {};
        DataTable.init('#order_datatable', columns, option);

        function DataTableCallback() {
            DataTable.reload();
        }
    </script>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Danh sách Đơn hàng</h3>
            {{--                <a href="{{route('order.create')}}" style="width: 85px;float: right;" type="button"--}}
            {{--class="btn btn-block btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Thêm</a>--}}
        </div>
        <div class="box-body">
            <table id="order_datatable" class="table table-bordered table-striped"
                   action="{{route('order.datatable')}}">
            </table>
        </div>
    </div>
@endsection