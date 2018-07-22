@extends('page.layout.main')

@section('content')
<!-- banner page -->
<div id="BannerPage">
    <div id="carouselId" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselId" data-slide-to="0" class="active"></li>
            <li data-target="#carouselId" data-slide-to="1"></li>
            <li data-target="#carouselId" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img src="https://www.bhdstar.vn/wp-content/uploads/2018/03/BHD-Star-CangDongCangVui-FIXED-1920x1080-WEB.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img src="https://www.bhdstar.vn/wp-content/uploads/2018/03/BHD-Star-WC2018-Teasing-1920x1080.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img src="https://www.bhdstar.vn/wp-content/uploads/2018/05/BHD-Star-32-55k-1920x1080.jpg" alt="Second slide">
            </div>
        </div>
    </div>
</div>
<!-- banner page -->

<!-- banner page -->
<div id="CinemaPage">

    <!-- container -->
    <div class="container">
        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="phimdangchieu-tab" data-toggle="tab" href="#phimdangchieu" role="tab" aria-controls="phimdangchieu"
                    aria-selected="true">
                    <i class="fas fa-video"></i> PHIM ĐANG CHIẾU</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="phimsapchieu-tab" data-toggle="tab" href="#phimsapchieu" role="tab" aria-controls="phimsapchieu"
                    aria-selected="false">
                    <i class="fas fa-film"></i> PHIM SẮP CHIẾU</a>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="phimdangchieu" role="tabpanel" aria-labelledby="phimdangchieu-tab">
                <!-- box cinema -->
                <div class="cinema-box">
                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        @foreach ($films as $film)
                            @if ($film->type == config('config.typefilm.showing') && $film->status == config('config.status.yes'))
                                <div class="col-6 col-sm-3 ">
                                    <div class="cinema-poster">
                                        <a href="{{ url("calendars/$film->id") }}">
                                            <img src="storage/img/film/{{$film->image}}" alt="">
                                        </a>
                                    </div>

                                    <div class="cinema-info text-left">
                                            <a href="{{ url("calendars/$film->id") }}">
                                            <h4>{{$film->name}}</h4>
                                        </a>
                                        <p class="small">{{$film->duration}} Phút</p>
                                    </div>

                                    <a class="btnBook" href="{{ url("calendars/$film->id") }}">
                                        <i class="fas fa-ticket-alt"></i> ĐẶT VÉ
                                    </a>
                                </div>
                            @endif
                        @endforeach
                        <!-- col -->
                    </div>
                    <!-- row -->
                </div>
                <!-- box cinema -->
            </div>


            <!-- nav tab -->
            <div class="tab-pane fade" id="phimsapchieu" role="tabpanel" aria-labelledby="phimsapchieu-tab">
                <!-- box cinema -->
                <div class="cinema-box">
                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        @foreach ($films as $film)
                            @if ($film->type == config('config.typefilm.coming') && $film->status == config('config.status.yes'))
                                <div class="col-6 col-sm-3 ">
                                    <div class="cinema-poster">
                                        <a href="lichchieu.html">
                                            <img src="storage/img/film/{{$film->image}}" alt="">
                                        </a>
                                    </div>

                                    <div class="cinema-info text-left">
                                        <a href="lichchieu.html">
                                            <h4>{{$film->name}}</h4>
                                        </a>
                                        <p class="small">{{$film->duration}} Phút</p>
                                    </div>

                                    <a class="btnBook" href="lichchieu.html">
                                        <i class="fas fa-ticket-alt"></i> ĐẶT VÉ
                                    </a>
                                </div>
                            @endif
                        @endforeach
                        <!-- col -->


                    </div>
                    <!-- row -->
                </div>
                <!-- box cinema -->
            </div>
            <!-- nav tab -->
        </div>
    </div>
    <!-- container -->
</div>
<!-- banner page -->

<!-- promotion page -->
<div id="PromotionPage">

    <!-- container -->
    <div class="container">

        <!-- title box -->
        <div class="box-title">
            <h4>
                <i class="fas fa-gift"></i> KHUYẾN MÃI
            </h4>
        </div>
        <!-- title box -->

        <!-- carousel -->
        <div id="carouselIdPromotion" class="carousel slide text-center" data-ride="carousel">
            <ol class="carousel-indicators">
                @php $stt=0 @endphp
                @foreach ($promotion as $pr)
                        <li data-target="#carouselIdPromotion" data-slide-to="{{$stt++}}" class="select"></li>
                @endforeach
            </ol>

            <div class="carousel-inner" role="listbox">
                @foreach ($promotion as $pr)
                    <div class="carousel-item promotion">
                        <a href="{{url('promotion-detail', $pr->id)}}"><img src="storage/img/news/{{$pr->image}}" alt="Second slide"></a>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- carousel -->
    </div>
    <!-- container -->
</div>
<!-- promotion page -->

<!-- new page -->
<section id="NewSection">

    <!-- container -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="box-title">
                    <h4>
                        <i class="fas fa-newspaper"></i> TIN TỨC
                    </h4>
                </div>
                @foreach ($news as $new)
                    <div class="new-box">
                        <div class="row">
                            <div class="col-12 col-md-5 new-img">
                                <a href="{{ url('news-detail', $new->id) }}">
                                    <img src="storage/img/news/{{$new->image}}">
                                </a>
                            </div>
                            <div class="col-12 col-md-7 new-detail">
                                <a href="{{url('news-detail', $new->id)}}">
                                    <h4>{{$new->title}}</h4>
                                </a>
                                <p class="small date hidden-sm">{{$new->created_at}}</p>
                                <div class="description"> {!! substr($new->body,0,250).'...' !!}
                                    <a href="{{url('news-detail', $new->id)}}">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- col -->
        </div>
        <!-- row -->
    </div>
    <!-- container -->
</section>
<!-- new page -->
@endsection
@section('script')
    <script>
        $('.promotion:first-child').addClass('active');
        $('.select:first-child').addClass('active');
    </script>
@endsection
