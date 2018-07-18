@extends('admin.layout.index')

@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Sửa lịch chiếu phim: <b>{{ $calendar->film->name }}</b></h3>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="panel-body">
        <form action="admin/calendars/{{ $calendar->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Rạp phim</label>
                <select class="form-control" name="theater_id" id="theater">
                    <option value="{{ $calendar->room->theater->id }}">{{  $calendar->room->theater->name }}, {{  $calendar->room->theater->address }}</option>
                </select>
            </div>

            <div class="form-group">
                <label>Phòng chiếu</label>
                <select class="form-control" name="room_id" id="room">
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" @if ($calendar->room->id == $room->id) {{ 'selected' }} @endif >{{ $room->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Phim</label>
                <select class="form-control" name="film_id" >
                    <option value="{{ $calendar->film_id }}">{{ $calendar->film->name }}</option>
                </select>
            </div>

            <div class="form-group">
                <label>Ngày chiếu</label>
                <div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
                    <input class="form-control" type="text" readonly="" name="date_show" value="{{ $calendar->date_show }}">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Giờ chiếu</label>
                <div class="panel panel-default">
                    <div class="panel-heading">Thêm giờ chiếu cho lịch</div>
                    <div class="panel-body">
                        <div class="row">

                            @foreach ($calendar->calendarTimes as $calTime)
                                <div class="col-sm-5 nopadding">
                                    <div class="form-group">
                                        <select class="form-control" name="types[]">
                                            <option value="2D" @if ($calTime->type_ticket == '2D') {{ 'selected' }} @endif >2D</option>
                                            <option value="3D" @if ($calTime->type_ticket == '3D') {{ 'selected' }} @endif >3D</option>
                                            <option value="4D">4D</option>
                                        </select>
                                        <input type="hidden" class="form-control" name="types_id[]" value="{{ $calTime->id }}">
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <input id="time_show" type="text" class="form-control" name="time_shows[]" placeholder="Giá vé" value="{{ $calTime->time_show }}" required>
                                    </div>
                                </div>

                                <div class="col-sm-1 nopadding">
                                    <div class="input-group-btn nopadding">
                                        <button class="btn btn-success" type="button" onclick="ticket_price();">
                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-sm-1">
                                    <input type="checkbox" name="calendarTimes_id[]" value={{ $calTime->id }}>
                                    <i style="color:red" class="fa fa-trash-o fa-fw"></i>
                                </div>
                            @endforeach

                            <div id="ticket_price">
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <small>Bấm vào
                            <span class="glyphicon glyphicon-plus gs"></span> để thêm giá vé</small>,
                        <small>bấm vào
                            <span class="glyphicon glyphicon-minus gs"></span> để xoá.</small>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Sửa lịch chiếu</button>
        </form>
    </div>
</div>
@endsection
@section('script')
    <script>

        var room = 1;
        function ticket_price() {
            room++;
            var objTo = document.getElementById('ticket_price')
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "form-group removeclass" + room);
            var rdiv = 'removeclass' + room;
            divtest.innerHTML = '<div class="col-sm-5 nopadding"><div class="form-group"> <select class="form-control" name="types_add[]"><option value="2D">2D</option><option value="3D">3D</option><option value="4D">4D</option><option value="4D">5D</option><option value="IMAX">IMAX</option></select></div></div><div class="col-sm-5"><div class="form-group"><input id="time_show" type="text" class="form-control" name="time_shows_add[]" placeholder="Giá vé" required></div></div><div class="col-sm-2 nopadding"><div class="input-group-btn"><button class="btn btn-danger" type="button" onclick="remove_ticket_price('+ room +');"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button></div></div><div class="clear"></div>';

            objTo.appendChild(divtest)
        }
        function remove_ticket_price(rid) {
            $('.removeclass' + rid).remove();
        }

        $(function () {
            $("#datepicker").datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true
            }).datepicker();

            $('#time_show').timepicker({
                timeFormat: 'HH:mm',
            });

        })
    </script>
@endsection

