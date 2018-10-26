@extends('backend.layout.master')
@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Thêm Widget Sản phẩm', 'breadcrumbs'=>[
        ['url'=>'/admin', 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['label'=>'Bố cục website', 'icon'=>'<i class="fa fa-table"></i>'],
        ['label'=>'Thêm Widget Sản phẩm']
    ]])
@endsection
@section('content')
    <form class="form" method="POST" action="{{route('widget.product_widget.store')}}">
        {{ csrf_field() }}
        @include('backend.widget.product_widget.form')
    </form>
@endsection