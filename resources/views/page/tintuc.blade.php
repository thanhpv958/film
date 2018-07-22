@extends('page.layout.main')

@section('content')
<div id="NPPage">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('/')}}">
                        <i class="fas fa-home"></i> {{ __('news.home') }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('news.news') }}</li>
            </ol>
        </nav>

        <div class="np-box">
            <div class="row">
                @foreach($news as $new)
                    @if($new->type == config('config.type.new'))
                        @if($new->status == config('config.status.yes'))
                            <div class="col-sm-4">
                                <div class="card">
                                    <a href="{{url('news-detail',$new->id)}}">
                                    <img class="card-img-top" src="storage/img/news/{{$new->image}}"></a>
                                    <div class="card-body">
                                        <a href="{{ url('news-detail', $new->id) }}" class="card-title" style="color: green; font-size: 20px;">{{ $new->title }}</a>
                                        <div class="card-text">
                                            <p></p>
                                            {!! substr($new->body, 0, 200).'...' !!}
                                            <a href="{{ url('news-detail', $new->id) }}" style="color: green;">{{ __('news.viewDetail') }}</a>
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
