@extends('admin.layout.main')

@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Thêm người dùng mới</h3>
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
        {!! Form::open(['method' => 'POST', 'url' => 'admin/staf', 'files' => true]) !!}
            <div class="form-group">
                {!! Form::label('Tên') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Tên', 'required' => 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Email') !!}
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'required' => 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Ảnh') !!}
                {!! Form::file('image', ['class' => 'form-control'])  !!}
            </div>
            <div class="form-group">
                {!! Form::label('Ngày sinh') !!}
                {!! Form::text('birthday', null, ['class' => 'form-control', 'placeholder' => 'Ngày sinh', 'required' => 'required']) !!}
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
                {!! Form::select('role', [1 => 'Admin', 2 => 'Moderator', 3 => 'User'], null, ['class' => 'form-control']) !!}
            </div>
            {!!  Form::button('Thêm người dùng', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection

