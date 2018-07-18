@extends('admin.layout.index') @section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Thêm rạp phim mới</h3>
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
        {!! Form::open(['url' => 'admin/theaters', 'files' => true]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Tên rạp') !!}
                {!! Form::text('name',  old('name') , ['class' => 'form-control', 'placeholder' => 'Tên rạp phim', 'required' => '']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('phone', 'Điện thoại') !!}
                {!! Form::tel('phone',  old('phone') , ['class' => 'form-control', 'placeholder' => 'Số điện thoại liên hệ', 'required' => '']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('phone', 'Địa chỉ') !!}
                {!! Form::text('address',  old('address') , ['class' => 'form-control', 'placeholder' => 'Địa chỉ của rạp', 'required' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('image', 'Hình ảnh') !!}
                <span>(có thể chọn nhiều ảnh)</span>
                {!! Form::file('image_theater[]' , ['class' => 'form-control', 'multiple' => true, 'required' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Thông tin thêm') !!}
                {!! Form::text('description',  'Thông tin về rạp (lịch sử, giá vé)' , ['id' => 'description', 'class' => 'form-control', 'required' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('ticket_price', 'Giá vé') !!}
                <div class="panel panel-default">
                    <div class="panel-heading">Thêm giá vé cho rạp</div>
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-sm-5 nopadding">
                                <div class="form-group">
                                    {!! Form::select('types[]', ['2D' => '2D', '3D' => '3D', '4D' => '4D'], null, ['class' => 'form-control', 'required' => '']) !!}
                                </div>
                            </div>
                            <div class="col-sm-5 ">
                                <div class="form-group">
                                    {!! Form::text('price_per_tickets[]', null,  ['class' => 'form-control', 'placeholder' => 'Giá vé', 'required' => '']) !!}
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
            {!! Form::submit('Thêm rạp', ['class' => 'btn btn-primary']) !!}
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
        selector: '#description'
    });

</script>
@endsection
