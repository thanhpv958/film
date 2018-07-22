@extends('admin.layout.main')

@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Sửa tin tức, sự kiện</h3>
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
        {!! Form::open(['method' => 'PUT', 'url' => "admin/news/$new->id", 'files' => true]) !!}
            <div class="form-group">
                {!!  Form::label('Tiêu đề') !!}
                {!!   Form::text('title', $new->title, ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
            <div class="form-group">
                {!!  Form::label('Ảnh') !!}
                <img src="storage/img/news/{{$new->image}}" style="display:block;margin: 10px 0px; width: 30%;">
                {!! Form::file('image', ['class' => 'form-control'])  !!}
            </div>
            <div class="form-group">
                {!!  Form::label('Nội dung') !!}
                {!! Form::textarea('body' ,$new->body, ['class' => 'form-control', 'id' => 'editor']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Loại') !!}
                {!! Form::select('type', [1 => 'Tin tức', 2 => 'Khuyến mãi'],  $new->type, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!!  Form::label('Trạng thái') !!}
                <div class="radio">
                    <label>{!! Form::radio('status', 1, ($new->status == 1) ? true : '')!!}Hiển thị</label>
                </div>
                <div class="radio">
                    <label>{!! Form::radio('status', 0, ($new->status == 0) ? true : '')!!}Không hiển thị</label>
                </div>
            </div>
            {!!  Form::button('Sửa tin', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
        {!! Form::close() !!}
    </div>
</div>

@endsection
@section('script')
    <script>
        CKEDITOR.replace('editor')
    </script>
@endsection

