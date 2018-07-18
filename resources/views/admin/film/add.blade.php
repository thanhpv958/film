@extends('admin.layout.index')

@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Thêm phim mới</h3>
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
        <form action="admin/films" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Tên phim</label>
                <input type="text" class="form-control" placeholder="Tên phim" name="name" required >
            </div>
            <div class="form-group">
                <label>Poster</label>
                <input type="file" class="form-control" placeholder="Poster của phim" name="image" required >
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" rows="4" name="description" placeholder="Mô tả ngắn gọn về phim" required ></textarea>
            </div>

            <div class="form-group">
                <label>Thể loại</label>
                @foreach ($categories as $cat)
                <div class="checkbox">
                    <label><input type="checkbox" value="{{ $cat->id }}" name="category[]">{{ $cat->name }}</label>
                </div>
                @endforeach
            </div>

            <div class="form-group" id="datetimepicker">
                <label>Ngày khởi chiếu</label>
                <div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
                    <input class="form-control" type="text" readonly="" name="open_date"/>
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
            </div>

            <div class="form-group">
                <label>Thời lượng</label>
                <input type="number" class="form-control" placeholder="Thời lượng" name="duration" required >
            </div>

            <div class="form-group">
                <label>Trailer URL</label>
                <input type="url" class="form-control" placeholder="Link trailer phim" name="trailer_url" required >
            </div>

            <div class="form-group">
                <label>Loại phim</label>
                <select class="form-control" name="type">
                    <option value="dangchieu">Phim đang chiếu</option>
                    <option value="sapchieu">Phim sắp chiếu</option>
                </select>
            </div>

            <div class="form-group">
                <label>Loại phim</label>
                <div class="radio">
                    <label><input type="radio" name="status" value="1" checked >Hiển thị</label>
                </div>

                <div class="radio">
                    <label><input type="radio" name="status" value="0" >Không hiển thị</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="button">Thêm phim</button>
        </form>
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



