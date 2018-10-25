@extends('backend.layout.master')

@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Chỉnh sửa bài viết', 'breadcrumbs'=>[
        ['url'=>'/admin', 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['url'=>route('post.index'), 'label'=>'Bài viết', 'icon'=>'<i class="fa fa-table"></i>'],
        ['label'=>'Sửa bài viết']
    ]])
@endsection

@section('content')
    <form class="form" method="POST" action="{{ route('post.update',$post->id) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        {{ Form::hidden('id', $post->id) }}
        @include('backend.post.form')
    </form>
@endsection