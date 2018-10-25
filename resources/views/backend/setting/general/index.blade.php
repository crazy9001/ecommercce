@extends('backend.layout.master')
@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Cấu hình chung', 'sub_title'=>'', 'breadcrumbs'=>[
        ['url'=>route('admin'), 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['label'=>'Cấu hình chung']
    ]])
@endsection
@section('content')
    <div class="row">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Cấu hình chung</h3>
            </div>
            <div class="box-body">
                <form role="form" class="ajax_submit" action="{{route('setting.general.store')}}" method="POST"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3">
                                {{Form::cSwitch('Trạng thái website', 'status', 1, @$settings['status'], ['data-on-color'=>"success", 'data-off-color'=>"danger", 'data-on-text'=>"Online", 'data-off-text'=>"Offline"])}}
                                {{Form::cFileSingle('Favicon', 'favicon', old('favicon')?old('favicon'):@$settings['favicon'], '', '50px')}}
                            </div>
                            <div class="col-md-9">
                                {{Form::cTextEditor('Thông tin liên hệ', 'contact_editor', @$settings['contact_editor'],'400px')}}
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        {{Form::cSubmit('Cập nhật')}}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection