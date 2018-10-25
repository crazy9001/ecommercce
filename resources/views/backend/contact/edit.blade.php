@extends('backend.layout.master')
@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Chi tiết liên hệ', 'breadcrumbs'=>[
        ['url'=>'/admin', 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['url'=>route('contact.index'), 'label'=>'Liên hệ', 'icon'=>'<i class="fa fa-envelope-o" aria-hidden="true"></i>'],
        ['label'=>'Chi tiết liên hệ'],
    ]])
@endsection
@section('style')
    @parent
    <style>
        label.form-control {
            height: auto;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border"><h4>Thông tin</h4></div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Họ tên</label>
                        <label class="form-control">{{$contact['name']}}</label>
                    </div>
                    <div class="form-group">
                        <label>Điện thoại</label>
                        <a class="form-control" href="tel:{{$contact['phone']}}">{{$contact['phone']}}</a>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <a class="form-control" href="mailto:{{$contact['email']}}">{{$contact['email']}}</a>
                    </div>
                    <div class="form-group">
                        <label>Tin nhắn</label>
                        <label class="form-control">{{$contact['message']}}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <form role="form" class="ajax_submit" action="{{route('contact.update', @$contact['contact_id'])}}"
                  method="POST"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="box">
                    <div class="box-header with-border"><h4>Admin</h4></div>
                    <div class="box-body">
                        <div class="form-group">
                            <input hidden name="contact[read]" value="0">
                            {{Form::cCheckbox('Đã xem', 'contact[read]', 1, @$contact['read']?1:0)}}
                        </div>
                        {{Form::cTextArea('Ghi chú cúa Admin', 'contact[note]', @$contact['note'])}}
                    </div>
                    <div class="box-footer text-center">
                        <a type="button" href="{{route('contact.index')}}" class="btn btn-default">
                            <i class="fa fa-undo" aria-hidden="true"></i> Quay lại
                        </a>

                        <button class="btn btn-success" type="submit">
                            <i class="fa fa-cloud-upload" aria-hidden="true"></i> Cập nhật
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
