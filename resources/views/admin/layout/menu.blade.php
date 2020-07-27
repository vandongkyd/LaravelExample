<ul class="sidebar-menu scrollable pos-r">
    <li class="nav-item mT-30 nav-parent {{ Request::is('admins/dashboard') ? 'active' : '' }}">
        <a class="sidebar-link"
           href="{{ route("dashboard") }}">
            <span class="icon-holder"><i class="c-blue-500 ti-home"></i> </span>
            <span class="title">Dashboard</span>
        </a>
    </li>

    <li class="nav-item dropdown {{ Request::is('admins/category*') ? 'open' : '' }}">
        <a class="dropdown-toggle nav-parent {{ Request::is('admins/category') ? 'active' : '' }}">
            <span class="icon-holder"><i class="c-deep-purple-500 ti-list-ol"></i> </span>
            <span class="title">Thể Loại</span>
            <span class="arrow"><i class="ti-angle-right"></i></span>
        </a>
        <ul class="dropdown-menu">
            <li class="nav-child {{ Request::is('admins/category') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route("category.list") }}">
                    <i class="fa fa-circle"></i> Danh Sách Thể Loại
                </a>
            </li>
            <li class="nav-child {{ Request::is('admins/category/add') || Request::is('admins/category/edit/*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route("category.add") }}">
                    <i class="fa fa-circle"></i> Thêm Thể Loại
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item dropdown {{ Request::is('admins/product*') ? 'open' : '' }}">
        <a class="dropdown-toggle nav-parent {{ Request::is('admins/product') ? 'active' : '' }}">
            <span class="icon-holder"><i class="c-indigo-500 fa fa-cube"></i> </span>
            <span class="title">Sản Phẩm</span>
            <span class="arrow"><i class="ti-angle-right"></i></span>
        </a>
        <ul class="dropdown-menu">
            <li class="nav-child {{ Request::is('admins/product') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route("product.list") }}">
                    <i class="fa fa-circle"></i> Danh Sách Sản Phẩm
                </a>
            </li>
            <li class="nav-child {{ Request::is('admins/product/add') || Request::is('admins/product/edit/*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route("product.add") }}">
                    <i class="fa fa-circle"></i> Thêm Sản Phẩm
                </a>
            </li>
        </ul>
    </li>


    <li class="nav-item dropdown {{ Request::is('admins/customer*') ? 'open' : '' }}">
        <a class="dropdown-toggle nav-parent {{ Request::is('admins/customer') ? 'active' : '' }}">
            <span class="icon-holder"><i class="c-light-blue-500 fa fa-users"></i> </span>
            <span class="title">Khách Hàng</span>
            <span class="arrow"><i class="ti-angle-right"></i></span>
        </a>
        <ul class="dropdown-menu">
            <li class="nav-child {{ Request::is('admins/customer') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route("customer.list") }}">
                    <i class="fa fa-circle"></i> Danh Sách Khách Hàng
                </a>
            </li>
            <li class="nav-child {{ Request::is('admins/customer/add') || Request::is('admins/customer/edit/*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route("customer.add") }}">
                    <i class="fa fa-circle"></i> Thêm Khách Hàng
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item dropdown {{ Request::is('admins/member*') ? 'open' : '' }}">
        <a class="dropdown-toggle nav-parent {{ Request::is('admins/member') ? 'active' : '' }}">
            <span class="icon-holder"><i class="c-brown-500 fa fa-user-md"></i> </span>
            <span class="title">Thành Viên</span>
            <span class="arrow"><i class="ti-angle-right"></i></span>
        </a>
        <ul class="dropdown-menu">
            <li class="nav-child {{ Request::is('admins/member') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route("member.list") }}">
                    <i class="fa fa-circle"></i> Danh Sách Thành Viên
                </a>
            </li>
            <li class="nav-child {{ Request::is('admins/member/add') || Request::is('admins/member/edit/*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route("member.add") }}">
                    <i class="fa fa-circle"></i> Thêm Thành Viên
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item nav-parent">
        <a class="sidebar-link"
           href="{{route("admin.logout")}}" onclick="document.getElementById('logout-form').submit();">
            <span class="icon-holder"><i class="c-blue-500 ti-power-off"></i> </span>
            <span class="title">Đăng xuất</span>
        </a>
        <form id="logout-form" action="{{ url('admins/logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>
