@extends('admin.layout.index')

@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Sửa người dùng</h3>
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

    @if ($user->role != 0)
        <div class="panel-body">
            {!! Form::open(['method' => 'PUT', 'url' => "admin/users/$user->id", 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('Tên') !!}
                    {!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Tên', 'required' => 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Email') !!}
                    {!! Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => 'Email', 'required' => 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Ảnh') !!}
                    <img src="storage/{{$user->image}}" width="30%">
                    {!! Form::file('image', ['class' => 'form-control', 'style' => 'margin-top: 10px;'])  !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Ngày sinh') !!}
                    {!! Form::text('birthday', $user->birthday, ['class' => 'form-control', 'placeholder' => 'Ngày sinh', 'required' => 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Mật khẩu') !!}
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Mật khẩu', 'required' => 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Nhập lại mật khẩu') !!}
                    {!! Form::password('passwordAgain', ['class' => 'form-control', 'placeholder' => 'Nhập lại mật khẩu', 'required' => 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Vai trò') !!}
                    {!!  Form::select('role', [1 => 'Admin', 2 => 'Moderator', 3 => 'User'], $user->role, ['class' => 'form-control', (Auth::user()->role != $user->role ? 'disabled' : '')]) !!}
                </div>
                {!! Form::button('Sửa thông tin', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
            {!! Form::close() !!}
        </div>
    @else
        <div class="panel-body">
            <h4 class="alert alert-danger">Bạn không được phép sửa người này</h4>
        </div>
    @endif

</div>
@endsection

