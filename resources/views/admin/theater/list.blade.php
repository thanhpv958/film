@extends('admin.layout.main')

@section('content')

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Danh sách rạp phim</h3>
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
                            <th>Điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php ($stt=1)
                        @foreach ($theaters as $theater)
                            <tr class="odd gradeX" align="center">
                                <td>{{ $stt++ }}</td>
                                <td>{{ $theater->name }}</td>
                                <td>{{ $theater->phone }}</td>
                                <td>{{ $theater->address }}</td>
                                <td class="center">
                                    <form action="admin/theaters/{{ $theater->id }}/edit" method="GET" style="display: inline-block;">
                                        @csrf
                                        <button class="btn btn-info" type="submit"><i class="fas fa-edit"></i></button>
                                    </form>
                                    <form action="admin/theaters/{{ $theater->id }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                       <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
            </table>
            <a href="admin/theaters/create" class="btn btn-primary">Thêm rạp</a>
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
