<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" style="margin-bottom: 50px">
            <li class="header"><i class="fa fa-home" aria-hidden="true"></i> MỤC CHÍNH</li>
            <li class="<?= (route('admin') == request()->url())?'active':'' ?>">
                <a href="{{route('admin')}}">
                    <i class="fa fa-dashboard"></i> <span>Bảng điều khiển</span>
                </a>
            </li>

            <li class="<?= (route('order.index') == request()->url())?'active':'' ?>">
                <a href="{{route('order.index')}}"
                   class="<?= (route('order.index') == request()->url())?'active':'' ?>">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>Đơn hàng</span>
                    <span class="pull-right-container">
                        {{--<small class="label pull-right bg-yellow">4</small>--}}
                        <small class="label pull-right bg-gray color-palette">{{\App\Models\Order::countStatus(3)}}</small>
                        <small class="label pull-right bg-purple disabled color-palette">{{\App\Models\Order::countStatus(2)}}</small>
                        <small class="label pull-right bg-teal disabled color-palette">{{\App\Models\Order::countStatus(1)}}</small>
                    </span>
                </a>
            </li>

            <li class="<?= (route('contact.index') == request()->url())?'active':'' ?>">
                <a href="{{route('contact.index')}}"
                   class="<?= (route('contact.index') == request()->url())?'active':'' ?>">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i> <span>Liên hệ</span>
                    <span class="pull-right-container">
                      {{--<small class="label pull-right bg-yellow">4</small>--}}
                        <small class="label pull-right bg-green">{{\App\Models\Contact::count()}}</small>
                        <small class="label pull-right bg-red">{{\App\Models\Contact::countNew()}}</small>
                    </span>
                </a>
            </li>

            <li class="<?= (route('user.index') == request()->url())?'active':'' ?>">
                <a href="{{route('user.index')}}">
                    <i class="fa fa-users" aria-hidden="true"></i> <span>User</span>
                </a>
            </li>

            <li class="header"><i class="fa fa-list" aria-hidden="true"></i> MỤC NỘI DUNG</li>

            <li class="treeview <?= (strpos(request()->url(), route('product.index')) !== false)?'active':'' ?>">
                <a href="#">
                    <i class="fa fa-product-hunt"></i><span>Sản phẩm</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">

                    <li class="<?= (route('product.create') == request()->url())?'active':'' ?>">
                        <a href="{{route('product.create')}}">
                            <i class="fa fa-plus"></i> Thêm Sản phẩm
                        </a>
                    </li>

                    <li class="<?= (route('product.index') == request()->url())?'active':'' ?>">
                        <a href="{{route('product.index')}}">
                            <i class="fa fa-list"></i> Danh sách Sản phẩm
                            <span class="pull-right-container"><small
                                        class="label pull-right bg-blue">{{\App\Models\Product::count()}}</small></span>
                        </a>
                    </li>

                    <li class="<?= (route('product.category.index') == request()->url())?'active':'' ?>">
                        <a href="{{route('product.category.index')}}"
                           class="<?= (route('product.category.index') == request()->url())?'active':'' ?>">
                            <i class="fa fa-align-justify"></i> Danh mục Sản phẩm
                            <span class="pull-right-container">
                                <small class="label pull-right bg-red">{{\App\Models\ProductCategory::count()}}</small>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview <?= (strpos(request()->url(), route('post.index')) !== false)?'active':'' ?>">
                <a href="#">
                    <i class="fa fa-files-o"></i><span>Bài viết</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">

                    <li class="<?= (route('post.create') == request()->url())?'active':'' ?>">
                        <a href="{{route('post.create')}}">
                            <i class="fa fa-circle-o"></i> Thêm Bài viết
                        </a>
                    </li>

                    <li class="<?= (route('post.index') == request()->url())?'active':'' ?>">
                        <a href="{{route('post.index')}}">
                            <i class="fa fa-circle-o"></i> Danh sách Bài viết
                            <span class="pull-right-container"><small
                                        class="label pull-right bg-blue">{{\App\Models\Post::count()}}</small></span>
                        </a>
                    </li>

                    <li class="<?= (route('post.video.index') == request()->url())?'active':'' ?>">
                        <a href="{{route('post.video.index')}}">
                            <i class="fa fa-circle-o"></i> Danh sách Video
                            {{--<span class="pull-right-container"><small
                                        class="label pull-right bg-blue">{{\App\Models\Video::count()}}</small></span>--}}
                        </a>
                    </li>

                    <li class="<?= (route('post.category.index') == request()->url())?'active':'' ?>">
                        <a href="{{route('post.category.index')}}"
                           class="<?= (route('post.category.index') == request()->url())?'active':'' ?>">
                            <i class="fa fa-circle-o"></i> Danh mục Bài viết
                            <span class="pull-right-container">
                                <small class="label pull-right bg-red">{{\App\Models\PostCategory::count()}}</small>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="<?= (strpos(request()->url(), '/admin/page') !== false)?'active':'' ?>">
                <a href="{{ route('page.index') }}"><i class="fa fa-table"></i> <span>Trang</span></a>
            </li>


            <li class="treeview <?= (strpos(request()->url(), '/admin/widget') !== false || strpos(request()->url(), '/admin/menu') !== false)?'active':'' ?>">
                <a>
                    <i class="fa fa-television" aria-hidden="true"></i> <span>Bố cục website</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= (route('menu.index') == request()->fullUrl())?'active':'' ?>">
                        <a href="{{route('menu.index')}}">
                            <i class="fa fa-bars" aria-hidden="true"></i> <span>Menu chính</span>
                        </a>
                    </li>

                    <li class="<?= (route('widget.product_widget.index') == request()->url())?'active':'' ?>">
                        <a href="{{route('widget.product_widget.index')}}"><i class="fa fa-circle-o"></i> Widget Sản phẩm</a>
                    </li>

                </ul>
            </li>

            <li class="header"><i class="fa fa-cogs" aria-hidden="true"></i> CÀI ĐẶT</li>

            <li class="<?= (route('setting.general.index') == request()->url())?'active':'' ?>">
                <a href="{{route('setting.general.index')}}">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> <span>Cấu hình chung</span>
                </a>
            </li>

            <li class="<?= (route('setting.seo.index') == request()->url())?'active':'' ?>">
                <a href="{{route('setting.seo.index')}}">
                    <i class="fa fa-key" aria-hidden="true"></i> <span>SEO mặc định</span>
                </a>
            </li>

            <li class="<?= (route('setting.sitemap.index') == request()->url())?'active':'' ?>">
                <a href="{{route('setting.sitemap.index')}}">
                    <i class="fa fa-sitemap" aria-hidden="true"></i> <span>Sitemap</span>
                </a>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>