@extends('admin.layout.index')

@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Sửa giá vé</h3>
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
        {!! Form::open(['method' => 'PUT', 'url' => "admin/ticketprices/$ticketPrice->id"]) !!}
            <div class="form-group">
                {!!  Form::label('theater', 'Rạp phim') !!}
                {!!  Form::select('theater_id', $theaters, $ticketPrice->theater_id, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!!  Form::label('type', 'Loại vé') !!}
                {!!  Form::select('type', ['2D' => '2D', '3D' => '3D', '4D' => '4D'], $ticketPrice->type, ['class' => 'form-control', 'disabled' => '']) !!}
            </div>
            <div class="form-group">
                {!!  Form::label('ticketPrice', 'Giá vé') !!}
                {!!  Form::number('price_per_ticket', $ticketPrice->price_per_ticket, ['class' => 'form-control', 'placeholder' => 'Giá vé', 'required' => 'required']) !!}
            </div>

            {!!  Form::button('Thêm giá vé', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection

