@extends('admin.layout.main')

@section('content')

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Danh sách tin tức/ sự kiện</h3>
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
            <table class="table table-striped table-bordered table-hover" id="dataTables">
                <thead>
                    <tr align="center">
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Ảnh</th>
                        <th>Thể loại</th>
                        <th>Trạng thái</th>
                        <th>Ngày đăng</th>
                        <th>Người đăng</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt=1 ?>
                    @foreach ($news as $new)
                        <tr class="odd gradeX" align="center">
                            <td>{{$stt++}}</td>
                            <td style="text-transform: uppercase;" >{{ $new->title }}</td>
                            <td><img style="width: 80px; height:auto" src="storage/img/news/{{ $new->image }}"></td>
                            <td>{{ ($new->type == config('config.type.new') ? 'Tin tức' : 'Khuyến mãi') }}</td>
                            <td>
                                @if($new->status == 1)
                                    Hiển thị
                                @else
                                    Không hiển thị
                                @endif
                            </td>
                            <td> {{ $new->created_at }} </td>
                            <td>{{ $new->user->name }}</td>

                            <td class="text-center">
                                {!! Form::open(['method' => 'GET', 'url' => "admin/news/$new->id/edit", 'style' => 'display: inline-block']) !!}
                                    {!! Form::button('<i class="fas fa-edit"></i>', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                                {!! Form::close() !!}
                                {!! Form::open(['method' => 'DELETE', 'url' => "admin/news/$new->id", 'style' => 'display: inline-block']) !!}
                                    {!!  Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="admin/news/create" class="btn btn-primary">Thêm tin tức/ sự kiện</a>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            $('#dataTables').DataTable({
                "order": [[ 0, "desc" ]],
            });
        });
    </script>
@endsection
