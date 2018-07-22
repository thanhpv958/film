@extends('page.layout.main')

@section('content')
<div id="NPDetailPage">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('/')}}">
                        <i class="fas fa-home"></i>{{ __('promotion.home') }}
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{url('promotions')}}">{{ __('promotion.promotion') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{$promotion->title}}</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-sm-8">
                <div class="npdetail-box">
                    <div class="npdetail-title">
                        <h4>{{$promotion->title}}</h4>
                        <p class="small">{{$promotion->created_at}}</p>
                    </div>
                    <div class="npdetail-detail">
                        <img src="storage/img/news/{{$promotion->image}}">
                        <p> {!! $promotion->body !!} </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="relatednew-box">
                    <h4>{{ __('promotion.new') }}</h4>
                    <ul>
                        @foreach($latest as $latest)
                            <li>
                                <a href="{{url('promotion-detail',$latest->id)}}">{{$latest->title}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
