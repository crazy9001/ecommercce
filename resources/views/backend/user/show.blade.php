@extends('backend.layout.master')
@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Chi tiết User', 'breadcrumbs'=>[
        ['url'=>route('admin'), 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['url'=>route('user.index'), 'label'=>'Danh sách', 'icon'=>'<i class="fa fa-table"></i>'],
        ['label'=>'User', 'icon'=>'<i class="fa fa-user"></i>']
    ]])
@endsection
@section('content')
    <div class="box">
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th colspan="2" class="text-center">Thông tin khách hàng</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Họ tên</td>
                    <td class="text-bold">{{config("info.gender.$user->gender")}} {{$user->name}}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td class="text-bold">{{$user->email}}</td>
                </tr>
                <tr>
                    <td>Số điện thoại</td>
                    <td class="text-bold">{{$user->phone}}</td>
                </tr>
                <tr>
                    <td>Địa chỉ</td>
                    <td class="text-bold">{{$user->address}}, {{@$user->district->name}}
                        , {{@$user->province->name}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
