@extends('backend.layout.master')
@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Thêm Widget Xem nhiều Sản phẩm', 'breadcrumbs'=>[
        ['url'=>'/admin', 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['label'=>'Bố cục website', 'icon'=>'<i class="fa fa-table"></i>'],
        ['label'=>'Thêm Widget Xem nhiều Sản phẩm']
    ]])
@endsection
@section('content')
    <form class="form" method="POST" action="{{route('widget.most_view_product.store')}}">
        {{ csrf_field() }}
        @include('backend.widget.most_view_product.form')
    </form>
@endsection