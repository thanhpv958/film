@extends('admin.layout.main')

@section('content')

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Danh sách phòng chiếu</h3>
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
                        <th>Rạp</th>
                        <th>Phòng chiếu</th>
                        <th>Số hàng</th>
                        <th>Số ghế</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>

                <tbody>
                    @php $stt=1 @endphp
                    @foreach ($rooms as $room)
                        <tr class="odd gradeX" align="center">
                            <td>{{ $stt++ }}</td>
                            <td>{{ $room->theater->name }}</td>
                            <td>{{ $room->name }}</td>
                            <td>{{ $room->num_row }}</td>
                            <td>{{ $room->num_seat }}</td>
                            <td class="center">
                                {!! Form::open(['method' => 'GET', 'url' => "admin/rooms/$room->id/edit", 'style' => 'display: inline-block;']) !!}
                                    {!!  Form::button('<i class="fas fa-edit"></i>', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                                {!! Form::close() !!}
                                {!! Form::open(['method' => 'delete', 'url' => "admin/rooms/$room->id", 'style' => 'display: inline-block;']) !!}
                                    {!!  Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{url('admin/rooms/create') }}" class="btn btn-primary">Thêm phòng chiếu</a>
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

