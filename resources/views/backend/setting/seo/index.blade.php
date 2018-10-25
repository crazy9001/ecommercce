@extends('backend.layout.master')
@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'SEO Mặc định', 'sub_title'=>'', 'breadcrumbs'=>[
        ['url'=>route('admin'), 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['label'=>'SEO']
    ]])
@endsection
@section('content')
    <div class="row">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">SEO mặc định</h3>
            </div>
            <div class="box-body">
                <form role="form" class="ajax_submit" action="{{route('setting.general.store')}}" method="POST"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">
                        {{Form::cText('Tiêu đề SEO', 'seo[seo_title]', @$seo['seo_title'])}}
                        {{Form::cText('Từ khóa SEO', 'seo[seo_keywords]', @$seo['seo_keywords'], ['placeholder'=>'Từ khóa ...', 'data-role'=>'tagsinput'])}}
                        {{Form::cTextArea('Mô tả SEO', 'seo[seo_description]', @$seo['seo_description'])}}
                        {{Form::cSwitch('Index,Follow', 'seo[robots]', 1, @$seo['robots'], ['data-on-color'=>"success", 'data-off-color'=>"danger", 'data-on-text'=>"On", 'data-off-text'=>"Off"])}}

                    </div>

                    <div class="box-footer">
                        {{Form::cSubmit('Cập nhật')}}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection