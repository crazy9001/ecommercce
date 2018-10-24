<header class="main-header">
    <a href="/admin" class="logo">
        {{--<span class="logo-mini"><b>NL</b>NL</span>--}}
        {{--<span class="logo-lg"><b>NL</b>website</span>--}}
        <img src="{{asset('logo.png')}}" style="max-width: 100%">
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Redirect Home Page-->
                <li class="website-menu view_website">
                    <a href="/" class=" btn bg-purple btn-flat" target="_blank">
                        <i class="fa fa-external-link" aria-hidden="true"></i>
                        <span class="hidden-xs"> Website </span>
                    </a>
                </li>
                @php($admin = Auth::user())
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{getAvatar($admin['avatar'])}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{$admin['name']}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{getAvatar($admin['avatar'])}}" class="img-circle" alt="User Image">
                            <p>{{$admin['name']}}</p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{--{{route('admin.profile')}}--}}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-default btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Đăng xuất</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>