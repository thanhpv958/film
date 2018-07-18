@extends('admin.layout.index')
@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Sửa thông tin rạp: <b>{{ $theater->name }}</b></h3>
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

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="panel-body">
        {!! Form::open(['method' => 'put', 'url' => "admin/theaters/$theater->id", 'files' => true]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Tên rạp') !!}
                {!! Form::text('name', $theater->name, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('phone', 'Điện thoại') !!}
                {!! Form::tel('phone', $theater->phone, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('address', 'Địa chỉ') !!}
                {!! Form::text('address', $theater->address, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                <label for="email">Hình ảnh</label>
                <span>(có thể chọn nhiều ảnh)</span>

                <div class="row">
                    @foreach ($theater->imguploads as $img)
                        <div class="col-md-3">
                            <img style="margin: 10px 0px; width: 250px; height: auto;" src="img/theater/{{ $img->image }}">
                            <p class="text-center">
                                {!! Form::checkbox('image_theater_id[]', $img->id) !!}
                                <i style="color:red" class="fa fa-trash-o fa-fw"></i>
                            </p>
                        </div>
                    @endforeach
                </div>
                {!! Form::file('image_theater[]' , ['class' => 'form-control', 'multiple' => true]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Thông tin thêm') !!}
                {!! Form::text('description', $theater->description, ['id' => 'description', 'class' => 'form-control', 'required' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('price', 'Giá vé') !!}
                <div class="panel panel-default">
                    <div class="panel-heading">Thêm giá vé cho rạp (Loại vé, giá vé, hình ảnh)</div>
                    <div class="panel-body">
                        <div class="row">
                            @foreach ($ticketPrice as $tp)
                                <div class="col-sm-5 nopadding">
                                    <div class="form-group">
                                        <input type="hidden" name="idTicketPrice[]" value="{{ $tp->id }}">
                                        <select class="form-control" name="types[]">
                                            <option value="2D" @if ($tp->type == '2D') {{ 'selected'}} @endif >2D</option>
                                            <option value="3D" @if ($tp->type == '3D') {{ 'selected'}} @endif>3D</option>
                                            <option value="4D" @if ($tp->type == '4D') {{ 'selected'}} @endif>4D</option>
                                            <option value="4D" @if ($tp->type == '5D') {{ 'selected'}} @endif>5D</option>
                                            <option value="IMAX" @if ($tp->type == 'IMAX') {{ 'selected'}} @endif>IMAX</option>
                                        </select>
                                        <input type="hidden" class="form-control" name="typeTickets_id[]" value="{{ $tp->id }}">
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="price_per_tickets[]" placeholder="Giá vé" value="{{ $tp->price_per_ticket }}" required>
                                    </div>
                                </div>


                                <div class="col-sm-2 nopadding">
                                    <div class="input-group-btn nopadding">
                                        <button class="btn btn-success" type="button" onclick="ticket_price();">
                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                        </button>
                                    </div>
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
            <button type="submit" class="btn btn-primary">Sửa rạp</button>
        {!! Form::close() !!}
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
        divtest.innerHTML = '<div class="col-sm-5 nopadding"><div class="form-group"> <select class="form-control" name="types[]"><option value="2D">2D</option><option value="3D">3D</option><option value="4D">4D</option><option value="4D">5D</option><option value="IMAX">IMAX</option></select></div></div><div class="col-sm-5"><div class="form-group"><input type="number" class="form-control" name="price_per_tickets[]" placeholder="Giá vé"  required></div></div><div class="col-sm-2 nopadding"><div class="input-group-btn"><button class="btn btn-danger" type="button" onclick="remove_ticket_price('+ room +');"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button></div></div><div class="clear"></div>';
        objTo.appendChild(divtest)
    }
    function remove_ticket_price(rid) {
        $('.removeclass' + rid).remove();
    }

    tinymce.init({
        selector: '#description',
        plugins: "image",
    });
</script> @endsection
