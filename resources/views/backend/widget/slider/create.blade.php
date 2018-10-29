@extends('backend.layout.master')
@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Thêm Slider', 'breadcrumbs'=>[
        ['url'=>'/admin', 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['label'=>'Bố cục website', 'icon'=>'<i class="fa fa-table"></i>'],
        ['label'=>'Thêm Slider']
    ]])
@endsection
@section('content')
    <form class="form" method="POST" action="{{route('widget.slider.store')}}">
        {{ csrf_field() }}
        @include('backend.widget.slider.form')
    </form>
@endsection