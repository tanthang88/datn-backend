<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
        <span class="brand-text font-weight-light">FivePass Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image" />
            </div>
            <div class="info text-white">
                @if(!empty(Auth::user()))
                {{Auth::user()->name}}
                @endif
            </div>
        </div>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search" />
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item  {{Route::currentRouteName()=='home'?'menu-is-opening menu-open':''}}">
                    <a href="/" class="nav-link  ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Trang chủ</p>
                    </a>
                </li>
                <li class="nav-item {{ in_array(Route::current()->getPrefix(),array('/post','/postCategories'))?'menu-is-opening menu-open':''}}">
                    <a href="#" class="nav-link">
                        <i class="fa fa-th pl-1" aria-hidden="true"></i>
                        <p class="pl-2">
                            Bài Viết
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('post.list')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('postCategory.list')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh mục</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Route::current()->getPrefix()=='/supplier'?'menu-is-opening menu-open':''}}">
                    <a href="#" class="nav-link">
                    <i class="fa fa-tasks" aria-hidden="true"></i>
                        <p class="pl-2">
                            Nhà cung cấp
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('supplier.add')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('supplier.list')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ in_array(Route::current()->getPrefix(),array('/product','/categoriesProduct'))?'menu-is-opening menu-open':''}}">
                    <a href="#" class="nav-link">
                        <i class="fa fa-th pl-1" aria-hidden="true"></i>
                        <p class="pl-2">
                            Sản phẩm
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('product.list')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('categoryProduct.list')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh mục</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Route::current()->getPrefix()=='/user'?'menu-is-opening menu-open':''}}">
                    <a href="#" class="nav-link">
                    <i class="fa fa-users" aria-hidden="true"></i>
                        <p class="pl-2">
                            Khách hàng
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">1</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Route::current()->getPrefix()=='/staff'?'menu-is-opening menu-open':''}}">
                    <a href="#" class="nav-link">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                        <p class="pl-2">
                            Nhân viên
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('staff.add') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('staff.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Route::current()->getPrefix()=='/role'?'menu-is-opening menu-open':''}}">
                    <a href="#" class="nav-link">
                    <i class="fa fa-tasks" aria-hidden="true"></i>
                        <p class="pl-2">
                            Phân quyền
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('role.add') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('role.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Route::current()->getPrefix()=='/about'?'menu-is-opening menu-open':''}}">
                    <a href="#" class="nav-link">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                        <p class="pl-2">
                            Về chúng tôi
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">1</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('about.list')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ in_array(Route::current()->getPrefix(),array('promotion/discount-code','promotion/discount','promotion/dealsock'))?'menu-is-opening menu-open':''}}">
                    <a href="#" class="nav-link">
                        <i class="fa fa-gift" aria-hidden="true"></i>
                        <p class="pl-2">
                            Khuyến mãi
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">3</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('promotion.discount-code.list')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mã khuyến mãi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('promotion.discount.list')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Giảm giá sản phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('promotion.dealsock.list')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mua kèm Deal sốc</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Route::current()->getPrefix()=='/Slider'?'menu-is-opening menu-open':''}}">
                    <a href="#" class="nav-link">
                    <i class="fa fa-align-left" aria-hidden="true"></i>
                        <p class="pl-2">
                            Slider
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('slider.add')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('slider.list')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Route::current()->getPrefix()=='/Banner'?'menu-is-opening menu-open':''}}">
                    <a href="#" class="nav-link">
                    <i class="fa fa-align-left" aria-hidden="true"></i>
                        <p class="pl-2">
                            Banner
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('banner.add')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('banner.list')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <p class="pl-2">
                            Đơn hàng
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('order.list')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ in_array(Route::current()->getPrefix(),array('shop/info','shop/feeship'))?'menu-is-opening menu-open':''}}">
                    <a href="#" class="nav-link">
                    <i class="fa fa-archive" aria-hidden="true"></i>
                        <p class="pl-2">
                            Cửa hàng
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('info.edit')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thông tin </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('feeship.list')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Phí ship</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

