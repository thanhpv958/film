@extends('page.layout.main')

@section('content')
<div id="NPPage">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('/')}}">
                        <i class="fas fa-home"></i>{{ __('promotion.home') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('promotion.promotion') }}</li>
            </ol>
        </nav>
        <div class="np-box">
            <div class="row">
                @foreach($promotions as $promotion)
                    @if($promotion->type == config('config.type.promotion'))
                        @if($promotion->status == config('config.status.yes'))
                            <div class="col-sm-4">
                                <div class="card">
                                    <a href="{{url('promotion-detail',$promotion->id)}}">
                                        <img class="card-img-top" src="storage/img/news/{{$promotion->image}}">
                                    </a>
                                    <div class="card-body">
                                        <a href="{{ url('promotion-detail', $promotion->id) }}" class="card-title" style="color: green; font-size: 20px;">{{ $promotion->title }}</a>
                                        <div class="card-text">
                                            <p></p>
                                            {!! substr($promotion->body,0,200).'...' !!}
                                            <a href="{{url('promotion-detail',$promotion->id)}}" style="color: green;">{{ __('promotion.viewDetail') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
