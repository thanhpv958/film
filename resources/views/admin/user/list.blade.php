@extends('admin.layout.main')

@section('content')

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Danh sách người dùng</h3>
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
                            <th>Email</th>
                            <th>Ảnh</th>
                            <th>Vai trò</th>
                            <th>Ngày sinh</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $stt=1 @endphp
                        @foreach ($users as $user)
                            @if ($user->role == 0 || $user->role == 1 || $user->role == 2)
                                <tr class="odd gradeX" align="center">
                                    <td>{{ $stt++ }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><img style="width: 50px !important; height:auto" src="storage/img/user/{{ $user->image }}"></td>
                                    <td>
                                        @if ($user->role == 1) {{'Admin'}}
                                        @elseif ($user->role == 2) {{'Moderator'}}
                                        @elseif ($user->role == 0) {{'SuperAdmin'}}
                                        @endif
                                    </td>
                                    <td>{{ $user->birthday }}</td>
                                    <td class="center">
                                        <form action="admin/users/{{ $user->id }}/edit" method="GET" style="display: inline-block;">
                                            @csrf
                                            <button class="btn btn-info" type="submit"><i class="fas fa-edit"></i></button>
                                        </form>
                                        <form action="admin/users/{{ $user->id }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
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

