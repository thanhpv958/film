@extends('page.layout.main')

@section('content')
<!-- price page -->
<div id="PricePage">

    <!-- container -->
    <div class="container">

        <!-- box title -->
        <div class="box-title">
            <h4>
                <i class="far fa-calendar-alt"></i> HỆ THỐNG RẠP / GIÁ VÉ
            </h4>
        </div>
        <!-- box title -->

        <!-- choose theater -->
        @if (isset($theater))
            <div class="theater-box">
                <div class="row">
                    <div class="col-12 col-md-7 theater-slide">
                        <!-- carousel theater slide -->
                        <div id="carouselIdPrice" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @for ($i = 0; $i < count($imgUpload); $i++)
                                        <li data-target="#carouselIdPrice" data-slide-to="{{$i}}" class=""></li>
                                    @endfor
                                </ol>
                            <div class="carousel-inner" role="listbox">
                                @for ($i = 0; $i < count($imgUpload); $i++)
                                    <div class="carousel-item">
                                        <img src="storage/img/theater/$imgUpload->image" alt="Second slide">
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <!-- carousel theater slide -->
                    </div>

                    <div class="col-12 col-md-5 theater-info">
                        <h4 class="title">{{ $theater->name }}</h4>
                        <p>Địa chỉ:
                            <span>{{ $theater->address }}</span>
                        </p>
                        <p>Số điện thoại:
                            <span>{{ $theater->phone }}</span>
                        </p>
                        <a class="btn-block" href='{{ url()->current() }}#map-box'>
                            <i class="fas fa-map-marker"></i> XEM VỊ TRÍ</a>
                        </div>
                    </div>
                </div>
                <div class="price-box">
                    <h4>
                        <i class="fas fa-gift"></i> THÔNG TIN
                    </h4>
                    <p>{{ $theater->description}}</p>
                </div>
                <div id="map-box">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.1598386436112!2d105.81112531485509!3d20.986228994604982!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acece990eb99%3A0x4aba2beec6e7024f!2zNDYwIMSQxrDhu51uZyBLaMawxqFuZyDEkMOsbmgsIEjhuqEgxJDDrG5oLCBUaGFuaCBYdcOibiwgSMOgIE7hu5lpLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1529056623212"width="100%" height="450" frameborder="0"style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        @else
        <div class="choose-theater">
            <select class="custom-select" id="selectTheater">
                <option value='0' selected >Mời bạn chọn rạp phim</option>
                    @foreach ($theaters as $theater)
                        <option value="{{ $theater->id }}">{{ $theater->name }} - {{ $theater->address }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <!-- choose theater -->

        <div class="theater-box">
        </div>
        @endif
    </div>
    <!-- container -->
</div>
<!-- price page -->
@endsection

@section('script')
    <script>
        $(function () {
            $('ol.carousel-indicators li:first-child').addClass('active');
            $('.carousel-item:first-child').addClass('active');

            $('#selectTheater').change(function () {
                if ($('#selectTheater').val() == 0) {
                    $('.theater-box').html('');
                } else {
                    $.ajax({
                        url: 'ajaxTheater/' + $('#selectTheater').val(),
                        type: 'get',
                        dataType: 'json',
                        success:function (data) {
                            var imgUpload = data['imgUpload'];
                            var theater = data['theater'];

                            var html = '<div class="row">';
                            html += '<div class="col-12 col-md-7 theater-slide">';
                            html += '<div id="carouselIdPrice" class="carousel slide" data-ride="carousel">';
                            html += '<ol class="carousel-indicators">';
                            for (var i = 0; i < imgUpload.length; i++) {
                                if (i == 0) {
                                    html += '<li data-target="#carouselIdPrice" data-slide-to="' + i + '" class="active"></li>';
                                } else {
                                html += '<li data-target="#carouselIdPrice" data-slide-to="' + i + '"></li>';

                                }
                            }
                            html += '</ol>';
                            html += '<div class="carousel-inner" role="listbox">';

                            for (var i = 0; i < imgUpload.length; i++) {
                                if (i == 0) {
                                    html += '<div class="carousel-item active">';
                                    html += '<img src="storage/img/theater/' + imgUpload[i]['image'] + '"Second slide"></div>';
                                } else {
                                    html += '<div class="carousel-item">';
                                    html += '<img src="storage/img/theater/' + imgUpload[i]['image'] + '"Second slide">'
                                    html += '</div>';
                                }
                            }
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';

                            html += '<div class="col-12 col-md-5 theater-info">';
                            html += '<h4 class="title">' + theater['name'] +'</h4>';
                            html += '<p>Địa chỉ:<span> ' + theater['address'] + '</span></p>';
                            html += ' <p>Số điện thoại: <span>' + theater['phone'] +'</span></p>';
                            html += '<a class="btn-block" href="theaters#map-box"><i class="fas fa-map-marker"></i> XEM VỊ TRÍ</a></div></div>';
                            html += '<div class="price-box"><h4><i class="fas fa-gift"></i> THÔNG TIN</h4><p>' + theater['description'] + '</p></div>';
                            html += '<div id="map-box">';
                            html += '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.1598386436112!2d105.81112531485509!3d20.986228994604982!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acece990eb99%3A0x4aba2beec6e7024f!2zNDYwIMSQxrDhu51uZyBLaMawxqFuZyDEkMOsbmgsIEjhuqEgxJDDrG5oLCBUaGFuaCBYdcOibiwgSMOgIE7hu5lpLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1529056623212"width="100%" height="450" frameborder="0"style="border:0" allowfullscreen></iframe>';
                            html += '</div>';
                            $('.theater-box').html(html);
                        }
                    })
                }
            })
        })
    </script>
@endsection
