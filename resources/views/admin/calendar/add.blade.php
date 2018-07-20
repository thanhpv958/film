@extends('admin.layout.index')

@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Thêm lịch chiếu mới</h3>
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
        <form action="admin/calendars" method="POST">
            @csrf

            <div class="form-group">
                <label>Rạp phim</label>
                <select class="form-control" name="theater_id" id="theater">
                    @foreach ($theaters as $theater)
                        <option value="{{ $theater->id }}">{{ $theater->name }}, {{ $theater->address }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Phòng chiếu</label>
                <select class="form-control" name="room_id" id="room" required>
                </select>
            </div>

            <div class="form-group">
                <label>Phim</label>
                <select class="form-control" name="film_id">
                    @foreach ($films as $film)
                        <option value="{{ $film->id }}">{{ $film->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Ngày chiếu</label>
                <div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
                    <input class="form-control" type="text" readonly="" name="date_show" value="{{ old('date_show') }}"/>
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Giờ chiếu</label>
                <div class="panel panel-default">
                    <div class="panel-heading">Thêm giờ chiếu cho lịch</div>
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-sm-5 nopadding">
                                <div class="form-group">
                                    <select class="form-control" name="types[]">
                                        <option value="2D">2D</option>
                                        <option value="3D">3D</option>
                                        <option value="4D">4D</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <input id="time_show" type="text" class="form-control time_show" name="time_shows[]" placeholder="Giá vé"  required>
                                </div>
                            </div>
                            <div class="col-sm-2 nopadding">
                                <div class="input-group-btn nopadding">
                                    <button class="btn btn-success" type="button" onclick="ticket_price();">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>

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

            <button type="submit" class="btn btn-primary">Thêm lịch chiếu</button>
        </form>
    </div>
</div>
@endsection
@section('script')
    <script>
        function ajaxRoom()
        {
            $.ajax({
                url: 'admin/calendars/ajaxRoom/' + $('#theater').val(),
                type: 'get',
                dataType: 'json',
                success:function (data) {
                    var rooms = data['rooms'];
                    var html = '';
                    for (var i=0; i < rooms.length; i++) {
                        html += "<option value='" + rooms[i]['id'] + "'>" + rooms[i]['name'] + "</option>";
                    }
                    $('#room').html(html);

                }
            });
        }

        var room = 1;
        function ticket_price() {
            room++;
            var objTo = document.getElementById('ticket_price')
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "form-group removeclass" + room);
            var rdiv = 'removeclass' + room;
            divtest.innerHTML = '<div class="col-sm-5 nopadding"><div class="form-group"> <select class="form-control" name="types[]"><option value="2D">2D</option><option value="3D">3D</option><option value="4D">4D</option><option value="4D">5D</option><option value="IMAX">IMAX</option></select></div></div><div class="col-sm-5"><div class="form-group"><input id="time_show" type="text" class="form-control time_show" name="time_shows[]" placeholder="Giá vé" required></div></div><div class="col-sm-2 nopadding"><div class="input-group-btn"><button class="btn btn-danger" type="button" onclick="remove_ticket_price('+ room +');"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button></div></div><div class="clear"></div>';
            objTo.appendChild(divtest)

            $('.time_show').timepicker({
                timeFormat: 'HH:mm',
            });

        }
        function remove_ticket_price(rid) {
            $('.removeclass' + rid).remove();
        }

        $(function () {
            $(window).on('load', ajaxRoom);
            $('#theater').change(ajaxRoom);

            $("#datepicker").datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true
            }).datepicker('update', new Date());

            $('.time_show').timepicker({
                timeFormat: 'HH:mm',
            });
        })

    </script>
@endsection

