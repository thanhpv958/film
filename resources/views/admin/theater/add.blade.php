@extends('admin.layout.main') @section('content')
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
                {!! Form::text('description',  'Thông tin về rạp (lịch sử, giá vé)' , ['id' => 'editor', 'class' => 'form-control', 'required' => '']) !!}
            </div>

            {!! Form::submit('Thêm rạp', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('script')
<script>
    CKEDITOR.replace('editor');
</script>
@endsection
