@extends('admin.layout.main')
@section('content')
<div class="row">
    <div class="col-md-7">
        <!-- TODO LIST -->
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Thống kê</h3>
                <div class="right">
                    <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                    <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                </div>
            </div>
            <div class="panel-body" style="display: block;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-download"></i></span>
                            <p>
                                <span class="number">{{ $filmCount }}</span>
                                <span class="title">Phim đang chiếu</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-shopping-bag"></i></span>
                            <p>
                                <span class="number">203</span>
                                <span class="title">Sales</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-eye"></i></span>
                            <p>
                                <span class="number">{{ $seatCount }}</span>
                                <span class="title">Ghế đã đặt</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-bar-chart"></i></span>
                            <p>
                                <span class="number">35%</span>
                                <span class="title">Conversions</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END TODO LIST -->
    </div>
    <div class="col-md-5">
        <!-- TIMELINE -->
        <div class="panel panel-scrolling">
            <div class="panel-heading">
                <h3 class="panel-title">Hoạt động người dùng</h3>
                <div class="right">
                    <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                    <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                </div>
            </div>
            <div class="panel-body">
                <ul class="list-unstyled activity-list">
                    @foreach ($comments as $comment)
                    <li>
                        <img src="storage/img/user/{{ $comment->user->image }}" alt="Avatar" class="img-circle pull-left avatar">
                        <p><a href="{{ url('user/' . $comment->user->id) }}">{{ $comment->user->name }}</a> bình luận <i>{{ $comment->body }} </i>
                          ở phim {{ $comment->film->name }}<span class="timestamp">{{ $comment->film->created_at }}</span></p>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- END TIMELINE -->
    </div>
</div>
@endsection
