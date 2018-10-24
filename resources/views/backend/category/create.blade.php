@extends('backend.layout.master')
@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Chỉnh sửa danh mục', 'breadcrumbs'=>[
        ['url'=>'/admin', 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['url'=>route("$type.category.index"), 'label'=>'Danh mục', 'icon'=>'<i class="fa fa-table"></i>'],
        ['label'=>'Chỉnh sửa danh mục']
    ]])
@endsection

@section('content')

    <form class="form" method="POST" action="{{route("$type.category.store")}}">
        {{ csrf_field() }}
        @include('backend.category.form')
    </form>
@endsection