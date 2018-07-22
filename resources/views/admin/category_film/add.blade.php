@extends('admin.layout.main')

@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Thêm thể loại mới</h3>
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
        {!! Form::open(['method' => 'POST', 'url' => 'admin/category-film']) !!}
            <div class="form-group">
                {!!  Form::label('Tên thể loại') !!}
                {!!   Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Tên thể loại', 'required' => 'required']) !!}
            </div>
            {!!  Form::button('Thêm', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('script')
<script>
    $(function () {
        $("#datepicker").datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true
        }).datepicker('update', new Date());
    });
</script>
@endsection



