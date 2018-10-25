@extends('backend.layout.master')
@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Thêm trang mới', 'breadcrumbs'=>[
        ['url'=>'/admin', 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['url'=>route('page.index'), 'label'=>'Danh sách trang', 'icon'=>'<i class="fa fa-table"></i>'],
        ['label'=>'Thêm trang nội dung']
    ]])
@endsection
@section('content')
    <form class="form" method="POST" action="{{ route('page.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        @include('backend.page.form')
    </form>
@endsection