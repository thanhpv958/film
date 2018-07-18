<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li>
                    <a href="admin" class="active">
                        <i class="lnr lnr-home"></i>
                        <span>Trang chủ</span>
                    </a>
                </li>
                <li>
                    <a href="#subPages1" data-toggle="collapse" class="collapsed">
                        <i class="lnr lnr-code"></i>
                        <span>Hệ thống rạp</span>
                        <i class="icon-submenu lnr lnr-chevron-left"></i>
                    </a>
                    <div id="subPages1" class="collapse ">
                        <ul class="nav">
                            <li>
                                <a href="admin/theaters" class="">Rạp phim</a>
                            </li>
                            <li>
                                <a href="admin/rooms" class="">Phòng chiếu</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#subPages2" data-toggle="collapse" class="collapsed">
                        <i class="lnr lnr-code"></i>
                        <span>Phim</span>
                        <i class="icon-submenu lnr lnr-chevron-left"></i>
                    </a>
                    <div id="subPages2" class="collapse ">
                        <ul class="nav">
                            <li>
                                <a href="admin/films" class="">Phim đang chiếu</a>
                            </li>
                            <li>
                                <a href="admin/films/" class="">Phim sắp chiếu</a>
                            </li>
                            <li>
                                <a href="admin/films/create" class="">Thêm phim</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="notifications.html" class="">
                        <i class="lnr lnr-alarm"></i>
                        <span>Lịch chiếu</span>
                    </a>
                </li>
                <li>
                    <a href="#subPages3" data-toggle="collapse" class="collapsed">
                        <i class="lnr lnr-file-empty"></i>
                        <span>Tin tức/ Sự kiện</span>
                        <i class="icon-submenu lnr lnr-chevron-left"></i>
                    </a>
                    <div id="subPages3" class="collapse ">
                        <ul class="nav">
                            <li>
                                <a href="{{url('admin/news')}}" class="">Danh sách</a>
                            </li>
                            <li>
                                <a href="{{url('admin/news/create')}}" class="">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @if (Auth::user()->role == 1 )
                    <li>
                        <a href="#subPages4" data-toggle="collapse" class="collapsed">
                            <i class="lnr lnr-file-empty"></i>
                            <span>Khách hàng</span>
                            <i class="icon-submenu lnr lnr-chevron-left"></i>
                        </a>
                        <div id="subPages4" class="collapse ">
                            <ul class="nav">
                                <li>
                                    <a href="{{url('admin/customer')}}" class="">Danh sách</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/users/create')}}" class="">Thêm mới</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#subPages5" data-toggle="collapse" class="collapsed">
                            <i class="lnr lnr-file-empty"></i>
                            <span>Nhân viên</span>
                            <i class="icon-submenu lnr lnr-chevron-left"></i>
                        </a>
                        <div id="subPages5" class="collapse ">
                            <ul class="nav">
                                <li>
                                    <a href="{{url('admin/users')}}" class="">Danh sách</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/users/create')}}" class="">Thêm mới</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>
