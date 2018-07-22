@extends('admin.layout.main')

@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Thêm tin tức, sự kiện</h3>
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
        {!! Form::open(['method' => 'POST', 'url' => 'admin/news', 'files' => true]) !!}
            <div class="form-group">
                {!! Form::label('Tiêu đề') !!}
                {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Tiêu đề', 'required' => 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Ảnh') !!}
                {!! Form::file('image', ['required' => 'required', 'class' => 'form-control'])  !!}
            </div>
            <div class="form-group">
                {!!  Form::label('Nội dung') !!}
                {!! Form::textarea('body' , null , ['class' => 'form-control', 'id' => 'editor', 'required' => 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Loại') !!}
                {!! Form::select('type', [1 => 'Tin tức', 2 => 'Khuyến mãi'], null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!!  Form::label('Trạng thái') !!}
                <div class="radio">
                    <label>{!! Form::radio('status', 1, true)!!}Hiển thị</label>
                </div>
                <div class="radio">
                    <label>{!! Form::radio('status', 0)!!}Không hiển thị</label>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('Người đăng') !!}
                {!! Form::text('user_name', Auth::user()->name, ['class' => 'form-control', 'disabled' => 'disabled', 'required' => 'required']) !!}
                {!! Form::hidden('user_id', Auth::user()->id) !!}
            </div>
            {!!  Form::button('Thêm tin', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('script')
<script>
    CKEDITOR.replace('editor');
</script>
@endsection


