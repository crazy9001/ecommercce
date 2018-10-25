@extends('backend.layout.master')
@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Thêm bài viết', 'breadcrumbs'=>[
        ['url'=>'/admin', 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['url'=>route('post.index'), 'label'=>'Bài viết', 'icon'=>'<i class="fa fa-table"></i>'],
        ['label'=>'Thêm bài viết']
    ]])
@endsection
@section('content')
    <form class="form" method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        @include('backend.post.form')
    </form>
@endsection