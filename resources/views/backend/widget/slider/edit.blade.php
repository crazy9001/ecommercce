@extends('backend.layout.master')
@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Chỉnh sửa Slider', 'breadcrumbs'=>[
        ['url'=>'/admin', 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['url'=>route('widget.slider.index'), 'label'=>'Slider', 'icon'=>'<i class="fa fa-table"></i>'],
        ['label'=>'Chỉnh sửa Slider']
    ]])
@endsection
@section('content')
    @php($slider = $widget)
    <form class="form" method="POST" action="{{route('widget.slider.update',[$slider->id])}}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        @include('backend.widget.slider.form')
    </form>
@endsection