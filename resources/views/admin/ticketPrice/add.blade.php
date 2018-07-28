@extends('admin.layout.main')

@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Thêm giá vé mới</h3>
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
        {!! Form::open(['method' => 'POST', 'url' => 'admin/ticketprices']) !!}
            <div class="form-group">
                {!!  Form::label('theater', 'Rạp phim') !!}
                {!!  Form::select('theater_id', $theaters, 'selected', ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!!  Form::label('type', 'Loại vé') !!}
                {!!  Form::select('type', ['2D' => '2D', '3D' => '3D', '4D' => '4D'], old('type'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!!  Form::label('price', 'Giá vé') !!}
                {!!  Form::number('price_per_ticket', old('price_per_ticket'), ['class' => 'form-control', 'placeholder' => 'Giá vé', 'required' => 'required']) !!}
            </div>

            {!!  Form::button('Thêm giá vé', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection

