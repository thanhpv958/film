@extends('admin.layout.main')

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

    <div class="panel-body">
        {!! Form::open(['method' => 'PUT', 'url' => "admin/users/$user->id", 'files' => true]) !!}
            <div class="form-group">
                {!! Form::label('Tên') !!}
                {!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Tên', 'required' => 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Email') !!}
                {!! Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => 'Email', 'disabled' => '']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Ảnh') !!}
                <img src="storage/img/user/{{$user->image}}" style="display:block;margin: 10px 0px; width: 20%;">
                {!! Form::file('image', ['class' => 'form-control', 'style' => 'margin-top: 10px;'])  !!}
            </div>
            <div class="form-group">
                {!! Form::label('Ngày sinh') !!}
                {!! Form::text('birthday', $user->birthday, ['id' => 'datepicker', 'class' => 'form-control', 'placeholder' => 'Ngày sinh']) !!}
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <div style="margin-left: 20px;">{!! Form::checkbox('check', null, null, ['id' => 'ChangePassCheck']) !!}</div>
                    {!! Form::label('ChangePassCheck', 'Đổi mật khẩu') !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('Mật khẩu') !!}
                {!! Form::password('password', ['class' => 'form-control passsword', 'placeholder' => 'Mật khẩu', 'required' => '', 'disabled' => '']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Nhập lại mật khẩu') !!}
                {!! Form::password('passwordAgain', ['class' => 'form-control passsword', 'placeholder' => 'Nhập lại mật khẩu', 'required' => '', 'disabled' => '']) !!}
            </div>
            @if ($user->role != 0)
            <div class="form-group">
                {!! Form::label('Vai trò') !!}
                {!! Form::select('role', [1 => 'Admin', 2 => 'Moderator', 3 => 'User'], $user->role, ['class' => 'form-control']) !!}
            </div>
            @endif
            {!! Form::button('Sửa thông tin', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('script')
<script>
    $("#datepicker").datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    }).datepicker();

    $('#ChangePassCheck').change(function() {
        if($(this).is(':checked'))
            $('.passsword').removeAttr('disabled');
        else {
            $('.passsword').attr('disabled','');
        }
    });

</script>
@endsection

