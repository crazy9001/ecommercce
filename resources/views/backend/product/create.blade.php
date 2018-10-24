@extends('backend.layout.master')

@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Thêm Sản phẩm', 'breadcrumbs'=>[
        ['url'=>'/admin', 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['url'=>route('product.index'), 'label'=>'Sản phẩm', 'icon'=>'<i class="fa fa-table"></i>'],
        ['label'=>'Thêm Sản phẩm']
    ]])
@endsection

@section('content')
    <form class="form" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        @include('backend.product.form')
    </form>
@endsection