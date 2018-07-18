@extends('admin.layout.index')

@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Thêm phòng chiếu mới</h3>
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
        {!! Form::open(['method' => 'PUT', 'url' => "admin/rooms/$room->id"]) !!}
        <div class="form-group">
                {!!  Form::label('theater', 'Rạp phim') !!}
                {!!  Form::select('theater_id', $select, "$room->theater_id", ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!!  Form::label('name', 'Tên phòng') !!}
                {!!   Form::text('name', "$room->name", ['class' => 'form-control', 'placeholder' => 'Tên phòng chiếu', 'required' => 'required']) !!}
            </div>
            <div class="form-group">
                {!!  Form::label('num_row', 'Số hàng') !!}
                {!!  Form::number('num_row', "$room->num_row", ['class' => 'form-control', 'placeholder' => 'Số hàng', 'required' => 'required']) !!}
            </div>
            <div class="form-group">
                {!!  Form::label('seat', 'Số ghế') !!}
                {!!  Form::number('num_seat', "$room->num_seat", ['class' => 'form-control', 'placeholder' => 'Số  ghế', 'required' => 'required']) !!}
            </div>
            {!!  Form::button('Sửa phòng chiếu', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
        </form>
        {!! Form::close() !!}
    </div>
</div>
@endsection

