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
                            <img style="margin: 10px 0px; width: 250px; height: auto;" src="storage/img/theater/{{ $img->image }}">
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

            <button type="submit" class="btn btn-primary">Sửa rạp</button>
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('script')
<script>
    tinymce.init({
        selector: '#description',
        plugins: "image",
    });
</script> @endsection
