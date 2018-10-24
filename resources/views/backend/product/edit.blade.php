@extends('backend.layout.master')

@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Chỉnh sửa Sản phẩm', 'breadcrumbs'=>[
        ['url'=>'/admin', 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['url'=>route('product.index'), 'label'=>'Sản phẩm', 'icon'=>'<i class="fa fa-table"></i>'],
        ['label'=>'Sửa Sản phẩm']
    ]])
@endsection

@section('content')
    <form class="form" method="POST" action="{{ route('product.update',$product->id) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        {{ Form::hidden('id', $product->id) }}
        @include('backend.product.form')
    </form>
@endsection