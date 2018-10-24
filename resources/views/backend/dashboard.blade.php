@extends('backend.layout.master')
@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Dashboard', 'sub_title'=>'Control panel', 'breadcrumbs'=>[]])
@endsection