<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link">Website</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('logout')}}" class="nav-link">Đăng xuất</a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge countNotiAll" ></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header"><span class="countNotiAll"></span> Thông báo </span>
                <div class="dropdown-divider"></div>
                <a href="{{route('contact.list')}}" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> <span class="countNotiContact"></span> Liên hệ mới
                    <span class="float-right text-muted text-sm dateNotiContact"></span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{route('order.list')}}" class="dropdown-item">
                <i class="fa fa-cart-arrow-down mr-2" aria-hidden="true"></i><span class="countNotiOrder"></span> Đơn hàng mới
                    <span class="float-right text-muted text-sm dateNotiOrder" ></span>
                </a>
                <div class="dropdown-divider"></div>
            </div>
        </li>
    </ul>
</nav>
@prepend('scripts')
<script type="module" src="{{Vite::asset('resources/js/contact/countNotification.js')}}"></script>
@endprepend
