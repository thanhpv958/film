@extends('page.layout.main')

@section('content')
<div id="NPDetailPage">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('/')}}">
                        <i class="fas fa-home"></i> {{ __('news.home') }}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{url('news')}}">{{ __('news.news') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{$new->title}}</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-sm-4">
                <img src="../storage/img/news/{{$new->image}}" alt="" width="100%">
            </div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="npdetail-box">
                            <div class="npdetail-title">
                                <h4>{{$new->title}}</h4>
                                <p class="small">{{$new->created_at}}</p>
                            </div>
                            <div class="npdetail-detail">
                                <p>
                                    {!! $new->body !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="main">
                            <div class="relatednew-box">
                                <h4>{{ __('news.new') }}</h4>
                                <ul>
                                    @foreach($latests as $latest)
                                        <li>
                                            <a href="{{url('news-detail', $latest->id)}}">{{$latest->title}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="relatednew-box">
                                <h4>{{ __('news.type') }}</h4>
                                <ul>
                                    <li>
                                        <a href="{{url('news')}}">{{ __('news.news') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{url('promotions')}}">{{ __('news.promotion') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
