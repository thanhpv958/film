@extends('page.layout.main')

@section('content')
<div id="BookTicketPage">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">
                        <i class="fas fa-home">{{ __('bookingTicket.home') }}</i> </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">{{ __('bookingTicket.book') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{$film->name}}</li>
            </ol>
        </nav>

        <div class="ticket-box">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="ticket-type">
                        <div class="row text-center">
                            <div class="col-4">
                                <i class="fas fa-square"></i> Standard
                            </div>

                            <div class="col-4">
                                <i class="far fa-square"></i> VIP
                            </div>

                            <div class="col-4">
                                <i class="fab fa-gratipay"></i> Double
                            </div>
                        </div>
                    </div>
                    <div class="ticket-choose">
                        <div class="screen">
                            <span class="text">{{ __('bookingTicket.screen') }}</span>
                        </div>
                        <table class="table table-borderless">
                            <tbody class="room">
                                @php
                                    $row = substr('ABCDEFGHIJKLMNOPQRSTUVWXYZ', $room->num_row-1, 1);
                                @endphp
                                @foreach (range('A', $row) as $char)
                                    @php $stt=0 @endphp
                                    <tr>
                                        <td>
                                            <label class="ng-binding">
                                                {{ __('bookingTicket.row') }} {{$char}}
                                            </label>
                                        </td>
                                        <td>
                                            @for ($j = 0; $j < $room->num_seat; $j++)
                                                <button class="btn_seat" name="seat_id" >
                                                    {{$char.$stt++}}
                                                </button>
                                            @endfor
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="ticket-status">
                        <div class="row text-center">
                            <div class="col-6 seat-active">
                                <i class="fas fa-square"></i>
                                <span>{{ __('bookingTicket.seated') }}</span>
                            </div>

                            <div class="col-6 seat-choosing">
                                <i class="fas fa-square"></i>
                                <span>{{ __('bookingTicket.selected') }}</span>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="ticket-timebook">
                            <p>Thời gian còn lại:
                                <span class="time"></span>
                            </p>
                            <div id="clock"></div>
                    </div>

                    <div class="ticket-detail">
                        <div class="film-info">
                            <div class="row">
                                <div class="col-5">
                                    <img src="storage/img/poster/{{$film->image}}" alt="">
                                </div>

                                <div class="col-7">
                                    <h5>{{$film->name}}</h5>
                                    <p>
                                        <i class="far fa-clock"></i> {{$film->duration}} {{ __('bookingTicket.minute') }}</p>
                                    <p>
                                        <i class="far fa-calendar-alt"></i> {{$film->open_date}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="theater-info">
                            <ul>
                                <li>
                                    <span class="col-left">{{ __('bookingTicket.theater') }}</span>
                                    <span class="col-right">{{$theater->name}}</span>
                                </li>
                                <li>
                                    <span class="col-left">{{ __('bookingTicket.day') }}</span>
                                    <span class="col-right">{{$film->open_date}}</span>
                                </li>
                                <li>
                                    <span class="col-left">{{ __('bookingTicket.room') }}</span>
                                    <span class="col-right">{{$room->name}}</span>
                                </li>
                                <li>
                                    <span class="col-left">{{ __('bookingTicket.time') }}</span>
                                    <span class="col-right">{{$calTime->time_show}}</span>
                                </li>
                                <li>
                                    <span class="col-left">{{ __('bookingTicket.type') }}</span>
                                    <span class="col-right">{{$calTime->type_ticket}}</span>
                                </li>
                                <li>
                                    <span class="col-left">{{ __('bookingTicket.price') }}</span>
                                    <span class="col-right priceTicket">
                                        @foreach ($ticketPrice as $tp)
                                            @if ($calTime->type_ticket == $tp->type)
                                                {{ $tp->price_per_ticket}}
                                            @endif
                                        @endforeach
                                    </span>
                                </li>
                            </ul>
                        </div>

                        <div class="ticket-info">
                            <div class="info-detail">
                                <div class="row">

                                    <div class="col-6 text-left">
                                        <span>{{ __('bookingTicket.selected') }}</span>
                                    </div>

                                    <div class="col-6 text-right">
                                        <span class="seat">{{ __('bookingTicket.empty') }}</span>
                                    </div>

                                    <div class="col-6 text-left">
                                        <span>{{ __('bookingTicket.amount') }}</span>
                                    </div>

                                    <div class="col-6 text-right">
                                        <span class="amount">{{ __('bookingTicket.empty') }}</span>
                                    </div>

                                    <div class="col-6 text-left">
                                        <span>{{ __('bookingTicket.total') }}</span>
                                    </div>

                                    <div class="col-6 text-right">
                                        <span class="price">{{ __('bookingTicket.empty') }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Button to Open the Modal -->
                            <a class="btnBook" data-toggle="modal" data-target="#myModal">
                                <i class="fas fa-ticket-alt"></i> {{ __('bookingTicket.book') }}</a>

                            <!-- The Modal -->
                            <div class="modal fade" id="myModal">
                                <div class="modal-dialog modal-lg ">
                                    <div class="modal-content">
                                        {!! Form::open(['method' => 'POST', 'url' => "booking-tickets/$calTime->id"]) !!}
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">{{ __('bookingTicket.cerbook') }}</h4>

                                        </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <div class="ticket-film-confirm">
                                                                <h6>{{ __('bookingTicket.film') }}:
                                                                    <span class="film-title">{{$film->name}}</span>
                                                                </h6>
                                                                <h6>{{ __('bookingTicket.theater') }}:
                                                                    <span>{{$theater->name}}</span>
                                                                </h6>
                                                                <h6>{{ __('bookingTicket.time') }}:
                                                                    <span>{{$film->open_date}}</span>
                                                                </h6>
                                                            </div>
                                                            <div class="ticket-seat-confirm">
                                                                <h6>{{ __('bookingTicket.seat') }}:
                                                                    <span class="seat">{{ __('bookingTicket.empty') }}</span>
                                                                </h6>
                                                                {{ __('bookingTicket.amount') }}:
                                                                    <span class="amount">{{ __('bookingTicket.empty') }}</span>
                                                                </h6>

                                                                <h6>{{ __('bookingTicket.total') }}:
                                                                    <span class="price">{{ __('bookingTicket.empty') }}</span>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <img src="fileupload/{{$film->image}}" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            {!! Form::hidden('getseat', null, ['class' => 'form-control seat']) !!}
                                            {!! Form::hidden('total_price', null, ['class' => 'form-control total_price']) !!}
                                            {!! Form::hidden('calTime_id', $calendar->id, ['class' => 'form-control']) !!}
                                            {!! Form::hidden('user_id', Auth::user()->id, ['class' => 'form-control amount']) !!}
                                            {!! Form::button("<i class='fas fa-ticket-alt'></i> CONFIRM", ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="page_assets/js/jquery.countdown.js"></script>
    <script>
        $(function () {
            $priceticket = $(".priceTicket").text();
            $('.btn_seat').click(function(){
                $(this).toggleClass('booking');
                $seat = $(".btn_seat.booking").text();
                $('.seat').text($seat + ' ');
                $amount = $(".btn_seat.booking").length;
                $('.amount').text($amount);
                function formatNumber (num) {
                    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
                }
                $price = formatNumber($amount*$priceticket);
                $('.price').text($price);

                $seat = $seat.replace(/\r?\n|\r/g, '');
                $seat = $seat.trim();
                $('input[name="getseat"]').val($seat);
                $('input[name="total_price"]').val($price);
            });

            var fiveSeconds = new Date().getTime() + 5*60*1000;
            $(".time").countdown(fiveSeconds, function (event) {
                $(this).text(event.strftime('%M:%S'));

                if (event.elapsed) {
                    window.location.href = "/";
                }
            });
        })
    </script>
@endsection
