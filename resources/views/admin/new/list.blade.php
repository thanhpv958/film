@extends('admin.layout.index')

@section('content')

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Danh sách phim</h3>
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
                        <th>Nội dung</th>
                        <th>Thể loại</th>
                        <th>Còn chiếu</th>
                        <th>Người đăng</th>
                        <th>Ngày đăng</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt=1 ?>
                    @foreach ($news as $new)
                        <tr class="odd gradeX" align="center">
                            <td>{{$stt++}}</td>
                            <td style="text-transform: uppercase;" >{{ $new->title }}</td>
                            <td><img style="width: 80px; height:auto" src="fileupload/{{ $new->image }}"></td>
                            <td>{{ substr($new->body,0,200).'...' }}</td>
                            <td>{{ ($new->type == config('config.type.new') ? 'Tin tức' : 'Khuyến mãi') }}</td>
                            <td>
                                @if($new->status === config('config.status.yes'))
                                    Còn chiếu
                                @else
                                    Hết chiếu
                                @endif
                            </td>
                            <td>
                                @foreach ($users as $user)
                                    @if ($user->user_id == $new->user_id)
                                        {{$user->name}}
                                    @endif
                                @endforeach
                            </td>
                            <td> {{$new->created_at}} </td>
                            <td class="text-center" style="display: inline-flex">
                                    {!! Form::open(['method' => 'GET', 'url' => "admin/news/$new->id/edit"]) !!}
                                    {!!  Form::button('<i class="fas fa-edit"></i>', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                                {!! Form::close() !!}
                                {!! Form::open(['method' => 'DELETE', 'url' => "admin/news/$new->id"]) !!}
                                    {!!  Form::button('<i class="fa fa-trash-o  fa-fw"></i>', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            $('#dataTables').DataTable({
                "order": [[ 0, "asc" ]],
            });
        });
    </script>
@endsection
