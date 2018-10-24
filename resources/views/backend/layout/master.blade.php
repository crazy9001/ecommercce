<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Quản trị Website</title>

    <!--Favicon-->
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Roboto&amp;subset=vietnamese" rel="stylesheet">

    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="/components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/components/Ionicons/css/ionicons.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="/components/iCheck/skins/all.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="/components/select2/dist/css/select2.min.css">

    <!-- Noty -->
    <link rel="stylesheet" href="/components/bootstrap-sweetalert/dist/sweetalert.css">
    <link rel="stylesheet" href="/components/animate.css/animate.min.css">
    <link rel="stylesheet" href="/components/noty/lib/noty.css">

    <!-- datetime -->
    <link rel="stylesheet" href="/components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" href="/components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- Bootstrap switch -->
    <link rel="stylesheet" href="/components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css">
    <link rel="stylesheet" href="/components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">

    <!-- Colorbox -->
    <link rel="stylesheet" href="/components/jquery-colorbox/example2/colorbox.css">

    <!-- Datatable -->
    <link rel="stylesheet" href="/components/datatables/media/css/dataTables.bootstrap.min.css">

    <link rel="stylesheet" href="/components/nestable2/jquery.nestable.css">

    <!-- file input -->
    <link href="/components/bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/assets/css/skins/_all-skins.min.css">

    <link rel="stylesheet" href="/assets/css/components.css">
    <link rel="stylesheet" href="/assets/css/datatable.css">

    <link rel="stylesheet" href="/assets/css/custom.css">


@yield('style')

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery 2.2.3 -->
    <script src="/components/jquery-v2/dist/jquery.min.js"></script>
    {{--<script src="/components/jquery/jquery.min.js"></script>--}}

</head>

<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">
    @include('backend.layout.core.header')
    @include('backend.layout.core.sidebar')
    <div class="content-wrapper">
        <section class="content-header">
            @yield('breadcrumb')
        </section>
        <section class="content">
            @include('backend.layout.core.notice')
            @yield('content')
        </section>
    </div>

    @include('backend.layout.core.footer')
</div>
<script>
    var _token = '{{ csrf_token() }}';
</script>
<!-- Bootstrap 3.3.6 -->
<script src="/components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/components/fastclick/lib/fastclick.js"></script>
<!-- iCheck -->
<script src="/components/iCheck/icheck.min.js"></script>
<!-- Select2 -->
<script src="/components/select2/dist/js/select2.full.min.js"></script>
<!-- autosize -->
<script src="/components/autosize/dist/autosize.min.js"></script>
<!-- datetime -->
<script src="/components/moment/moment.js"></script>
<script src="/components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="/components/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Colorbox -->
<script type="text/javascript" src="/components/jquery-colorbox/jquery.colorbox-min.js"></script>

<!-- the main fileinput plugin file -->
<script src="/components/bootstrap-fileinput/js/fileinput.min.js"></script>
<script src="/components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="/components/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>

<!-- Datatable -->
<script src="/components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="/components/datatables/media/js/dataTables.bootstrap.min.js"></script>

<script src="/components/nestable2/jquery.nestable.js"></script>

<!-- Noty -->
<script src="/components/bootstrap-sweetalert/dist/sweetalert.min.js"></script>
<script src="/components/noty/lib/noty.min.js"></script>
<script src="/assets/js/notify.js"></script>

<!-- AdminLTE App -->
<script src="/assets/js/app.min.js"></script>

<!-- JavaScript custom admin  -->
<script src="/assets/plugins/stringvn.js"></script>
<script src="/assets/js/components.js"></script>
<script src="/assets/js/ajaxSubmit.js"></script>
<script src="/assets/js/datatable.js"></script>
<script src="/assets/js/format.js"></script>

<!-- CK editor -->
<script src="/assets/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>

<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="/assets/plugins/ace/ace.js"></script>


@yield('script')

</body>
</html>
