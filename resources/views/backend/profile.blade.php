@extends('backend.layout.master')

@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Profile', 'sub_title'=>'', 'breadcrumbs'=>[
        ['url'=>route('admin'), 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['label'=>'Profile']
    ]])
@endsection
@section('content')
    @php($user = Auth::user())
    <form method="POST" action="{{ route('admin.profile') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>

                        <h3 class="box-title">Thông tin chính</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-6">
                            {{Form::cText('Họ tên', 'user[name]', old('user[name]')?old('user[name]'):@$user['name'], ['required'=>true, 'placeholder'=>'...'])}}
                            {{Form::cText('Email', 'user[email]', old('user[email]')?old('user[email]'):@$user['email'], ['required'=>true,'placeholder'=>'...'])}}
                        </div>
                        <div class="col-md-6">
                            {{Form::cPassword('Mật khẩu', 'password')}}
                            {{Form::cPassword('Nhập lại mật khẩu', 'password_confirmation')}}
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a type="button" href="{{route('admin')}}" class="btn btn-default">
                            <i class="fa fa-undo" aria-hidden="true"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-cloud-upload" aria-hidden="true"></i> Hoàn thành
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
    </form>
@endsection