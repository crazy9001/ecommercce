@extends('backend.layout.master')
@section('script')
    @parent
    <script>
        var DataTable = new DataTableClass();
        var columns = [
                {
                    title: 'Họ tên',
                    name: 'name',
                    data: 'name',
                    className: 'dataTable_name'
                },
                {
                    title: 'Điện thoại',
                    name: 'phone',
                    data: null,
                    render: function (data) {
                        if (data.phone) {
                            return '<a href="tel:' + data.phone + '">' + data.phone + '</a>'
                        }
                        return '';
                    },
                    className: 'dataTable_phone'

                },
                {
                    title: 'Email',
                    name: 'email',
                    data: null,
                    render: function (data) {
                        if (data.email) {
                            return '<a href="mailto:' + data.email + '">' + data.email + '</a>'
                        }
                        return '';
                    },
                    className: 'dataTable_email hidden-xs'
                },
                {
                    title: 'Nội dung',
                    name: 'message',
                    data: 'message',
                    className: 'dataTable_message'
                },
                {
                    title: 'Thời gian',
                    name: 'created_at',
                    data: 'created_at',
                    className: 'dataTable_date'
                },
                {
                    title: '',
                    data: null,
                    render: function (data) {
                        return DataTable.showReadButton(data) + DataTable.showDeleteButton(data.route_delete);
                    },
                    searchable: false,
                    className: 'dataTable_action text-center'
                }
            ]
        ;
        var option = {};
        DataTable.init('#table_contact', columns, option);

        function DataTableCallback() {
            DataTable.reload();
        }
    </script>
@endsection
@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Liên hệ', 'sub_title'=>'Các tin nhắn của khách hàng', 'breadcrumbs'=>[
        ['url'=>route('admin'), 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['label'=>'Liên hệ']
    ]])
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="table_contact" class="table table-bordered table-striped"
                           action="{{route('contact.datatable')}}"></table>
                </div>
            </div>
        </div>
    </div>
@endsection
