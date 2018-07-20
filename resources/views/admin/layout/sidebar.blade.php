<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li>
                    <a href="admin" @if (Request::is('admin')) class="active" @endif>
                        <i class="fas fa-home"></i>
                        <span>Trang chủ</span>
                    </a>
                </li>
                <li>
                    <a href="#subPages1" data-toggle="collapse"
                        @if (Request::is('admin/theaters') || Request::is('admin/ticketprices') || Request::is('admin/rooms'))
                            class="active"
                        @else
                            class="collapsed"
                        @endif
                    >
                        <i class="fas fa-video"></i>
                        <span>Hệ thống rạp</span>
                        <i class="icon-submenu lnr lnr-chevron-left"></i>
                    </a>

                    <div id="subPages1"
                        @if (Request::is('admin/theaters') || Request::is('admin/ticketprices') || Request::is('admin/rooms'))
                            class="collapse in"
                        @else
                            class="collapse"
                        @endif
                    >
                        <ul class="nav">
                            <li>
                                <a href="admin/theaters" @if (Request::is('admin/theaters')) class="active" @endif>Rạp phim</a>
                            </li>
                            <li>
                                <a href="admin/ticketprices" @if (Request::is('admin/ticketprices')) class="active" @endif>Giá vé</a>
                            </li>
                            <li>
                                <a href="admin/rooms" @if (Request::is('admin/rooms')) class="active" @endif>Phòng chiếu</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#subPages2" data-toggle="collapse"
                        @if (Request::is('admin/films') || Request::is('admin/comments'))
                            class="active"
                        @else
                            class="collapsed"
                        @endif
                    >
                        <i class="fas fa-film"></i>
                        <span>Phim</span>
                        <i class="icon-submenu lnr lnr-chevron-left"></i>
                    </a>
                    <div id="subPages2"
                        @if (Request::is('admin/films') || Request::is('admin/comments'))
                            class="collapse in"
                        @else
                            class="collapse"
                        @endif
                    >
                        <ul class="nav">
                            <li>
                                <a href="admin/films/" @if (Request::is('admin/films')) class="active" @endif>Danh sách phim</a>
                            </li>
                            <li>
                                <a href="admin/comments" @if (Request::is('admin/comments')) class="active" @endif>Bình luận</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="admin/calendars" @if (Request::is('admin/calendars')) class="active" @endif>
                        <i class="fas fa-calendar-alt"></i>
                        <span>Lịch chiếu</span>
                    </a>
                </li>
                <li>
                    <a href="#subPages3" data-toggle="collapse"
                        @if (Request::is('admin/news') || Request::is('admin/news/create'))
                            class="active"
                        @else
                            class="collapsed"
                        @endif
                    >
                        <i class="fas fa-newspaper"></i>
                        <span>Tin tức/ Sự kiện</span>
                        <i class="icon-submenu lnr lnr-chevron-left"></i>
                    </a>
                    <div id="subPages3"
                        @if (Request::is('admin/news') || Request::is('admin/news/create'))
                            class="collapse in"
                        @else
                            class="collapse"
                        @endif
                    >
                        <ul class="nav">
                            <li>
                                <a href="{{ url('admin/news') }}" @if (Request::is('admin/news')) class="active" @endif>Danh sách</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/news/create') }}" @if (Request::is('admin/news/create')) class="active" @endif>Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @if (Auth::user()->role == 1 || Auth::user()->role == 0)
                    <li>
                        <a href="#subPages4" data-toggle="collapse"
                            @if (Request::is('admin/staf') || Request::is('admin/staf/create'))
                                class="active"
                            @else
                                class="collapsed"
                            @endif
                        >
                            <i class="fas fa-user-tie"></i>
                            <span>Người dùng</span>
                            <i class="icon-submenu lnr lnr-chevron-left"></i>
                        </a>
                        <div id="subPages4"
                            @if (Request::is('admin/stafs') || Request::is('admin/customers') || Request::is('admin/users/create'))
                                class="collapse in"
                            @else
                                class="collapse"
                            @endif
                        >
                            <ul class="nav">
                                <li>
                                    <a href="{{ url('admin/stafs') }}" @if (Request::is('admin/stafs')) class="active" @endif>Nhân viên</a>
                                </li>

                                <li>
                                    <a href="{{ url('admin/customers') }}" @if (Request::is('admin/customers')) class="active" @endif>Khách hàng</a>
                                </li>
                                <li>
                                    <a href="{{ url('admin/users/create') }}" @if (Request::is('admin/users/create')) class="active" @endif>Thêm mới</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if (Auth::user()->role ==2)
                <li>
                        <a href="#subPages4" data-toggle="collapse"
                            @if (Request::is('admin/customers') || Request::is('admin/users/create'))
                                class="active"
                            @else
                                class="collapsed"
                            @endif
                        >
                            <i class="fas fa-user-tie"></i>
                            <span>Người dùng</span>
                            <i class="icon-submenu lnr lnr-chevron-left"></i>
                        </a>
                        <div id="subPages4"
                            @if (Request::is('admin/customers') || Request::is('admin/users/create'))
                                class="collapse in"
                            @else
                                class="collapse"
                            @endif
                        >
                            <ul class="nav">
                                <li>
                                    <a href="{{ url('admin/customers') }}" @if (Request::is('admin/customers')) class="active" @endif>Khách hàng</a>
                                </li>
                                <li>
                                    <a href="{{ url('admin/users/create') }}" @if (Request::is('admin/users/create')) class="active" @endif>Thêm mới</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>
