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
                            <th>Poster</th>
                            <th>Thể loại</th>
                            <th>Ngày khởi chiếu</th>
                            <th>Thời lượng</th>
                            <th>Trailer URL</th>
                            <th>Loại</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php ($stt=1)
                        @foreach ($films as $film)
                            <tr class="odd gradeX" align="center">
                                <td>{{ $stt++ }}</td>
                                <td style="text-transform: uppercase;" >{{ $film->name }}</td>
                                <td><img style="width: 50px; height:auto" src="img/film/{{ $film->image }}"></td>
                                <td>
                                    @foreach ($film->categories as $cat)
                                        {{ $cat->name }} {!! '<br>' !!}
                                    @endforeach
                                </td>
                                <td>{{ $film->open_date }} </td>
                                <td>{{ $film->duration }} </td>
                                <td>{{ $film->trailer_url }} </td>
                                <td>
                                    @if ($film->type == 1)
                                        {{ 'Đang chiếu '}}
                                    @else
                                        {{ 'Sắp chiếu '}}
                                    @endif
                                </td>
                                <td>
                                    @if ($film->status == 1)
                                        {{ 'Hiển thị'}}
                                    @else
                                        {{ 'Ko hiển thị'}}
                                    @endif
                                </td>

                                <td class="text-center">
                                    <form action="admin/films/{{ $film->id }}/edit" method="GET" style="display: inline-block;">
                                        @csrf
                                        <button class="btn btn-info" type="submit"><i class="fas fa-edit"></i></button>
                                    </form>
                                    <form action="admin/films/{{ $film->id }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                       <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
            </table>
            <a href="admin/films/create" class="btn btn-primary">Thêm phim</a>
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
