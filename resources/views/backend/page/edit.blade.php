@extends('backend.layout.master')
@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Chỉnh sửa trang', 'sub_title'=>'<a target="_blank" href="'.Pages::urlPage($page).'"><i class="fa fa-external-link" aria-hidden="true"></i> Xem</a>', 'breadcrumbs'=>[
        ['url'=>'/admin', 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['url'=>route('page.index'), 'label'=>'Danh sách trang', 'icon'=>'<i class="fa fa-table"></i>'],
        ['label'=>'Sửa trang nội dung']
    ]])
@endsection
@section('content')
    <form class="form" method="POST" action="{{ route('page.update',$page->id) }}"
          enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        {{ Form::hidden('id',$page->id) }}
        @include('backend.page.form')
    </form>
@endsection