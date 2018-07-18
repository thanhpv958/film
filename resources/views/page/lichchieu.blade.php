@extends('page.layout.main')

@section('content')
<!-- film page -->
<div id="FilmPage">

    <!-- container -->
    <div class="container">

        <!-- film detail -->
        <div class="film-box">

            <!-- row -->
            <div class="row">

                <!-- col -->
                <div class="col-12 col-md-5">
                    <div class="film-poster">
                        <img src="img/film/{{ $film->image }}" alt="">
                    </div>
                </div>
                <!-- col -->

                <!-- col -->
                <div class="col-12 col-md-7">

                    <!-- box detail -->
                    <div class="film-detail">
                        <h3>{{ $film->name }}</h3>
                        <p>{{ $film->description }}</p>
                    </div>
                    <!-- box detail -->

                    <!-- box tech -->
                    <div class="film-tech">

                    </div>
                    <!-- box tech -->

                    <!-- box info -->
                    <div class="film-info">
                        <ul>
                            <li>
                                <span class="col-left">Thể loại</span>
                                <span class="col-right">
                                    @foreach ($film->categories as $cat)
                                        {{ $cat->name }} {!! ' ' !!}
                                    @endforeach
                                </span>
                            </li>
                            <li>
                                <span class="col-left">Khởi chiếu</span>
                                <span class="col-right">{{ $film->open_date }}</span>
                            </li>
                            <li>
                                <span class="col-left">Thời lượng</span>
                                <span class="col-right">{{ $film->duration }} phút</span>
                            </li>
                            <li>
                                <span class="col-left">Tình trạng</span>
                                <span class="col-right">
                                    @if ($film->type == 1) {{ 'Đang chiếu' }}
                                    @else {{ 'Sắp chiếu' }}
                                    @endif
                                </span>
                            </li>
                        </ul>


                        <!-- box btn -->
                        <div class="film-btn">
                            <a class="btnTrailer" data-toggle="modal" data-target="#myModal">XEM TRAILER</a>
                            <a class="btnBook" href="calendars/{{ $film->id }}#time-box">
                                <i class="fas fa-ticket-alt"></i> ĐẶT VÉ</a>

                            <!-- The Modal -->
                            <div class="modal" id="myModal">
                                <div class="modal-dialog modal-lg">
                                    <iframe width="960" height="447" class="modal-content" src="{{ $film->trailer_url }}" frameborder="0"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- box btn -->
                </div>
                <!-- info -->
            </div>
            <!-- col -->
        </div>
        <!-- row -->

        <!-- film detail -->

        <!-- show time page -->
        <div id="time-box">

            <!-- box title -->
            <div class="box-title">
                <h4>
                    <i class="far fa-calendar-alt"></i> LỊCH CHIẾU
                </h4>
            </div>
            <!-- box title -->

            <!-- choose theater -->
            <div class="box-chooseTheater">
                <select class="custom-select" id="selectTheater">

                    <option value="0" selected >Mời bạn chọn rạp phim</option>
                    @foreach ($theaters as $theater)
                        <option value="{{ $theater->id }}">{{ $theater->name }} - {{ $theater->address }}</option>
                    @endforeach
                </select>
            </div>
            <!-- choose theater -->

            <div class="box-detail">
            </div>
        </div>
        <!-- show time page -->


        <div id="comment-box">
            <div class="box-title">
                <h4>
                    <i class="far fa-calendar-alt"></i> BÌNH LUẬN
                </h4>
            </div>
            <div class="comment-post">
                <div class="card">
                    <div class="card-header">Viết bình luận ...<i class="fas fa-pencil-alt"></i></div>
                    <div class="card-body">
                        {!! Form::open(['url' => 'admin/comments#comment-box']) !!}
                            <div class="form-group">
                                {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 3]) !!}
                                {!! Form::text('user_id', 1, ['hidden' => '']) !!}
                                {!! Form::text('film_id', $film->id, ['hidden' => '']) !!}
                            </div>
                            {!! Form::submit('Gửi', ['class' => 'btn btn-success']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="comment-body" style="background-color: #fff; margin-top: 30px;">
                    @foreach ($comments as $comment)
                        <div class="row" style="padding: 10px;" id="{{ $comment->id }}">
                            <div class="col-1">
                                <img src="img/user/{{ $comment->user->image }}">
                            </div>
                            <div class="col-9">
                                <h5>{{ $comment->user->name }}
                                    <span class="small" style="font-size: 12px;">{{ $comment->created_at }}</span>
                                </h5>
                                <p class="comment-text">{{ $comment->body }}</p>
                            </div>
                            <div class="col-2" style="margin-top:10px;">
                                {!! Form::submit('Edit', ['class' => 'btn btn-secondary btnEdit']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btnDelete']) !!}
                            </div>
                        </div>
                    @endforeach
            </div>
        </div>
    </div>
    <!-- container -->
</div>
<!-- film page -->
@endsection

@section('script')
<script>

    function selectTheater()
    {
        if ($('#selectTheater').val() == 0) {
                $('.box-detail').html('');
            } else {
                $.ajax({
                    url: 'ajaxCalendar/' + $('#selectTheater').val(),
                    type: 'get',
                    dataType: 'json',
                    success: function(data) {
                        var theater = data['theater'];
                        var calTimes = data['caltimes'];
                        console.log(calTimes);
                        var html = '<div class="row">';
                        html += '<div class="col-12 col-md-4 theater-detail">';
                        html += '<h4 class="title">' + theater['name'] + '</h4>'
                        html += '<p class="small">' + theater['address'] + '</p>';
                        html += '<a class="btn-block" href="theaters#map-box">';
                        html += '<i class="fas fa-map-marker"></i> XEM VỊ TRÍ</a>';
                        html += '</div>';
                        html += '<div class="col-12 col-md-8 time-detail">';
                        html += '<ul class="nav nav-tabs" id="myTab" role="tablist">';

                        $.each(calTimes, function(key, item) {

                            if (Object.keys(calTimes)[0] == key) {
                                html += '<li class="nav-item">';
                                $.each (item, function (key1, item1) {
                                    html += '<a class="nav-link active" data-toggle="tab" href="#thu' + item1['id'] +'"role="tab" aria-selected="true">' + key + '</a>';
                                    return false;
                                })
                                html += '</li>';

                            } else  {
                                html += '<li class="nav-item">';
                                $.each (item, function (key1, item1) {
                                    html += '<a class="nav-link" data-toggle="tab" href="#thu' + item1['id'] +'" role="tab" aria-selected="false">' + key + '</a>';
                                    return false;
                                })
                                html += '</li>';
                            }

                        })

                        html += '</ul>';

                        html += '<div class="tab-content" id="myTabContent">';

                        $.each(calTimes, function(key, item) {

                            if (Object.keys(calTimes)[0] == key) {
                                $.each (item, function (key1, item1) {
                                    html += '<div class="tab-pane fade show active" id="thu' +  item1['id'] + '" role="tabpanel" aria-labelledby="home-tab">';
                                    return false;
                                })
                                html += '<div class="row">';
                                html += '<div class="col-3 type">';

                                    $.each (item, function (key1, item1) {
                                        if (item1['type_ticket'] == '2D') {
                                            html += '<span>' + item1['type_ticket'] + '</span> Phụ đề';
                                            return false;
                                        }
                                    })
                                    html += '</div>';
                                    html += '<div class="col-9 time">'
                                    $.each (item, function (key1, item1) {
                                        if (item1['type_ticket'] == '2D') {
                                            html += '<a href="booking-tickets/' + item1['id'] +'">' + item1['time_show'] + '</a>';
                                        }
                                    })
                                    html += '</div>';
                                    html += '<div class="col-3 type">';
                                    $.each (item, function (key1, item1) {
                                        if (item1['type_ticket'] == '3D') {
                                            html += '<span>' + item1['type_ticket'] + '</span> Phụ đề</div>';
                                            return false;
                                        }
                                    })
                                    html += '<div class="col-9 time">'
                                    $.each (item, function (key1, item1) {
                                        if (item1['type_ticket'] == '3D') {
                                            html += '<a href="booking-tickets/' + item1['id'] +'">' + item1['time_show'] + '</a>';
                                        }
                                    })
                                    html += '</div>';

                                html += '</div>';
                                html += '</div>';

                            } else {
                                $.each (item, function (key1, item1) {
                                    html += '<div class="tab-pane fade " id="thu' +  item1['id'] + '" role="tabpanel" aria-labelledby="home-tab">';
                                    return false;
                                })
                                html += '<div class="row">';
                                html += '<div class="col-3 type">';

                                    $.each (item, function (key1, item1) {
                                        if (item1['type_ticket'] == '2D') {
                                            html += '<span>' + item1['type_ticket'] + '</span> Phụ đề</div>';
                                            return false;
                                        }
                                    })
                                    html += '<div class="col-9 time">'
                                    $.each (item, function (key1, item1) {
                                        if (item1['type_ticket'] == '2D') {
                                            html += '<a href="booking-tickets/' + item1['id'] +'">' + item1['time_show'] + '</a>';
                                        }
                                    })
                                    html += '</div>';
                                    html += '<div class="col-3 type">';
                                    $.each (item, function (key1, item1) {
                                        if (item1['type_ticket'] == '3D') {
                                            html += '<span>' + item1['type_ticket'] + '</span> Phụ đề</div>';
                                            return false;
                                        }
                                    })
                                    html += '<div class="col-9 time">'
                                    $.each (item, function (key1, item1) {
                                        if (item1['type_ticket'] == '3D') {
                                            html += '<a href="booking-tickets/' + item1['id'] +'">' + item1['time_show'] + '</a>';
                                        }
                                    })
                                    html += '</div>';

                                html += '</div>';
                                html += '</div>';
                            }
                        })

                        html += '</div>'
                        html += '</div>'
                        html += '</div>';
                        $('.box-detail').html(html);
                    }
                });
            }
    }

    $(function() {
        $('#myModal').on('hidden.bs.modal', function () {
            $('#myModal iframe').removeAttr('src');
        })

        // ajax theater
        $('#selectTheater').change(selectTheater);
        $(window).on('load', selectTheater);


        $('.btnEdit').click(function (event) {
            var clicks = $(this).data('clicks')
            if (clicks) {
                $(this).closest(".row").find('#commentForm').remove();
            } else {
                var id = $(this).closest(".row").attr('id');
                let body = $(this).closest(".row").find('.comment-text').html();
                let reply = '<div class="col-12">';
                reply += '<form id="commentForm">';
                reply += '<div class="form-group">';
                reply += '<textarea class="form-control" name="bodyEdit" id="bodyEdit" cols="30" rows="5" name="commentText" >'+body+'</textarea></div>';
                reply += '<button type="submit" style="margin-bottom:20px;"class="btn btn-success" id="comment-save">Save</button></form></div>';
                $(this).closest(".row").append(reply);

                $('#comment-save').on('click', function () {
                    var form = $("#commentForm").serializeArray();
                    var id = $(this).closest(".row").attr('id');
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'PUT',
                        url: '/admin/comments/'+id,
                        data: {
                            body: $('#bodyEdit').val(),
                        },
                        success: function (data) {
                            location.reload();
                        }
                    })
                });
            }
            $(this).data("clicks", !clicks);
        });

        $('.btnDelete').click(function () {
            var id = $(this).closest(".row").attr('id');
            console.log(id);
            if(confirm("Bạn chắc chắn muốn xoá comment này ?")) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'DELETE',
                    url: '/admin/comments/'+id,
                    data: {
                    },
                    success: function (data) {
                        location.reload();
                    }
                })
            }
        })
    })
</script>
@endsection
