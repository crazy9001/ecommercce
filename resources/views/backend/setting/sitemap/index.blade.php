@extends('backend.layout.master')

@section('breadcrumb')
    @include('backend.layout.core.breadcrumb', ['title'=>'Cấu hình Sitemap', 'sub_title'=>'', 'breadcrumbs'=>[
        ['url'=>route('admin'), 'label'=>'Dashboard', 'icon'=>'<i class="fa fa-dashboard"></i>'],
        ['label'=>'Cấu hình Sitemap']
    ]])
@endsection

@section('content')
    <div class="box box-default">
        <form role="form" class="ajax_submit" action="{{route('setting.sitemap.store')}}" method="POST"
              enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        {{ Form::cFileUpload('File Sitemap', 'sitemap_file') }}
                    </div>
                    <div class="col-md-12">
                        {{ Form::cCodeEditor('Nội dung', 'sitemap', $sitemap, 'xml') }}
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
                <a type="button" href="{{ route('setting.sitemap.generate') }}" class="btn btn-default">
                    <i class="fa fa-magic" aria-hidden="true"></i> Tạo sitemap tự động
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-cloud-upload" aria-hidden="true"></i> Hoàn thành
                </button>
            </div>
        </form>
    </div>
@endsection