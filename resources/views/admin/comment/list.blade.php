@extends('admin.layout.index')

@section('content')

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Danh sách comment</h3>
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
                            <th>User</th>
                            <th>Nội dung</th>
                            <th>Phim</th>
                            <th>Ngày đăng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php ($stt=1)
                        @foreach ($comments as $comment)
                            <tr class="odd gradeX" align="center">
                                <td>{{ $stt++ }}</td>
                                <td>{{ $comment->user->name }}</td>
                                <td>{{ $comment->body }}</td>
                                <td>{{ $comment->film->name }}</td>
                                <td>{{ $comment->created_at }}</td>
                                <td class="text-center">
                                    {!! Form::open(['method' => 'delete', 'url' => "admin/comments/$comment->id", 'style' => 'display: inline-block;']) !!}
                                       {!! Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                                    </form>
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
                "order": [[ 0, "desc" ]],
            });
        });
    </script>
@endsection


