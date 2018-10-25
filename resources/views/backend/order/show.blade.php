@extends('backend.layout.master')
@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Đơn hàng', 'breadcrumbs'=>[
        ['url'=>'/admin', 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['url'=>route('order.index'), 'label'=>'Đơn hàng', 'icon'=>'<i class="fa fa-table"></i>'],
        ['label'=>'Đơn hàng '.$order->code]
    ]])
@endsection


@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">#{{$order->code}}</h3>
        </div>
        <div class="box-body">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th colspan="2" class="text-center">Thông tin khách hàng</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Họ tên</td>
                        <td class="text-bold">{{config("info.gender.$order->gender")}} {{$order->name}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td class="text-bold">{{$order->email}}</td>
                    </tr>
                    <tr>
                        <td>Số điện thoại</td>
                        <td class="text-bold">{{$order->phone}}</td>
                    </tr>
                    <tr>
                        <td>Địa chỉ</td>
                        <td class="text-bold">{{$order->address}}, {{$order->district->name}}
                            , {{$order->province->name}}</td>
                    </tr>
                    @if($order->ship_another_address)
                        <tr style="color: red">
                            <td>Địa chỉ giao hàng</td>
                            <td class="text-bold">{{$order->saddress}}, {{$order->sdistrict->name}}
                                , {{$order->sprovince->name}}</td>
                        </tr>
                        <tr style="color: red">
                            <td>Tên người nhận hàng</td>
                            <td class="text-bold">{{$order->sname}}</td>
                        </tr>
                    @endif
                    <tr>
                        <td>Thời gian nhận hàng</td>
                        <td class="text-bold">{{config("info.delivery_time.$order->delivery_time")}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th colspan="2" class="text-center">Thông tin đơn hàng</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Ngày đăt hàng</td>
                        <td class="text-bold">{{$order->created_at->format('d/m/Y H:s')}}</td>
                    </tr>
                    <tr>
                        <td>Trạng thái đơn hàng</td>
                        <td class="text-bold">{{config("info.order_status.$order->status")}}</td>
                    </tr>
                    <tr>
                        <td>
                            <p>Trạng thái thanh toán</p>
                        </td>
                        <td class="text-bold text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" {{$order->payment_status?'checked':''}} id="payment">
                                </label>
                            </div>
                            <p style="color: red">{{config("info.payment_status.$order->payment_status")}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Phương thức thanh toán</td>
                        <td class="text-bold">
                            <p>{{config("info.payment.$order->payment")}}</p>
                            <p>{{$order->payment_method}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Ghi chú</td>
                        <td class="text-bold">{{$order->note}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th colspan="6" class="text-center">Sản phẩm</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center" width="60">Ảnh</th>
                        <th class="text-center">Tên Sản phẩm</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-center">Giá</th>
                        <th class="text-center">Thành tiền</th>
                    </tr>
                    @foreach($order->items as $item)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td><img src="{{$item['pro_thumb']}}" style="width: 50px;height: 50px"></td>
                            <td>{{$item['pro_name']}}</td>
                            <td class="text-center">{{$item['qty']}}</td>
                            <td class="text-right"><span class="price">{{$item['price']}}</span>đ</td>
                            <td class="text-right"><span class="price">{{$item['subtotal']}}</span>đ</td>
                        </tr>
                    @endforeach
                    <tr style="font-size: 16px">
                        <th colspan="5" class="text-right">Tổng cộng</th>
                        <th class="text-right"><span class="price">{{$order->total}}</span>đ</th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer">
            @if($order->status<4 && $order->status>0)
                <button class="btn btn-danger" id="btn-cancel-order">Hủy đơn hàng</button>
            @endif
            @if($order->status<4 && $order->status>1)
                @php($pre_status = $order->status - 1)
                <button class="btn btn-default" id="btn-prev-status-order">
                    <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                    {{config("info.order_status.$pre_status")}}
                </button>
            @endif
            @if($order->status<4 && $order->status>0)
                @php($next_status = $order->status + 1)
                <button class="btn btn-info pull-right"
                        id="btn-next-status-order">{{config("info.order_status.$next_status")}} <i
                            class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
            @endif

            @if($order->status==-1)
                <button class="btn btn-success pull-right" id="btn-reopen-order">Mở lại đơn hàng</button>
            @endif
        </div>
    </div>
@endsection

@section('script')
    @parent
    <script>
        $(document).on('click', '#btn-cancel-order', function () {
            var data = {
                _token: _token,
                status: -1
            };
            swal({
                    title: "Cảnh báo",
                    text: "Bạn có chắc hủy đơn hàng này?",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Hủy",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Đồng ý",
                    closeOnConfirm: true
                },
                function () {
                    _ajax('{{route('order.update', $order->id)}}', 'PATCH', data)
                });
        });
        $(document).on('click', '#btn-reopen-order', function () {
            var data = {
                _token: _token,
                status: 1
            };
            swal({
                    title: "Cảnh báo",
                    text: "Bạn có chắc mở lại đơn hàng này?",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Hủy",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Đồng ý",
                    closeOnConfirm: true
                },
                function () {
                    _ajax('{{route('order.update', $order->id)}}', 'PATCH', data)
                });
        });
        $(document).on('click', '#btn-next-status-order', function () {
            var data = {
                _token: _token,
                status: '{{$order->status + 1}}'
            };
            if (data.status == 4) {
                swal({
                        title: "Thông báo",
                        text: "Hoàn tất đơn hàng",
                        type: "success",
                        showCancelButton: true,
                        cancelButtonText: "Hủy",
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Đồng ý",
                        closeOnConfirm: true
                    },
                    function () {
                        _ajax('{{route('order.update', $order->id)}}', 'PATCH', data)
                    });
            } else {
                swal({
                        title: "Cảnh báo",
                        text: "Chuyển trạng thái đơn hàng?",
                        type: "warning",
                        showCancelButton: true,
                        cancelButtonText: "Hủy",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Đồng ý",
                        closeOnConfirm: true
                    },
                    function () {
                        _ajax('{{route('order.update', $order->id)}}', 'PATCH', data)
                    });
            }
        });
        $(document).on('click', '#btn-prev-status-order', function () {
            var data = {
                _token: _token,
                status: '{{$order->status - 1}}'
            };
            swal({
                    title: "Cảnh báo",
                    text: "Chuyển trạng thái đơn hàng?",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Hủy",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Đồng ý",
                    closeOnConfirm: true
                },
                function () {
                    _ajax('{{route('order.update', $order->id)}}', 'PATCH', data)
                });
        });
        $(document).on('click', '#payment', function () {
            var data = {_token: _token};
            if ($(this).is(":checked")) {
                data.payment_status = 1;
            } else {
                data.payment_status = 0;
            }

            var self = $(this);
            swal({
                    title: "Cảnh báo",
                    text: "Chuyển trạng thái đơn hàng?",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Hủy",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Đồng ý",
                    closeOnConfirm: true
                },
                function (isConfirm) {
                    if (isConfirm) {
                        _ajax('{{route('order.update', $order->id)}}', 'PATCH', data)
                    } else {
                        self.prop("checked", !self.prop("checked"));
                    }
                });
        });
    </script>
@endsection
