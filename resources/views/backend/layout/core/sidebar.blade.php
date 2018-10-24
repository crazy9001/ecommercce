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

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>