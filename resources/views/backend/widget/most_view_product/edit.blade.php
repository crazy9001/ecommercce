@extends('backend.layout.master')
@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Chỉnh sửa Widget Sản phẩm', 'breadcrumbs'=>[
        ['url'=>'/admin', 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['url'=>route('widget.product_widget.index'), 'label'=>'Widget Sản phẩm', 'icon'=>'<i class="fa fa-table"></i>'],
        ['label'=>'Chỉnh sửa Widget Sản phẩm']
    ]])
@endsection
@section('content')
    @php($product_widget = $widget)
    <form class="form" method="POST" action="{{route('widget.most_view_product.update',[$product_widget->id])}}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        @include('backend.widget.most_view_product.form')
    </form>
@endsection