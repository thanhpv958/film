@extends('admin.layout.index')

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
                        <?php $stt=1 ?>
                        @foreach ($users as $user)
                            @if ($user->role == 1 || $user->role == 2)
                                <tr class="odd gradeX" align="center">
                                    <td>{{ $stt++ }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><img src="fileupload/{{ $user->image }}" alt="" style="height:80px"></td>
                                    <td>{{ ($user->role == 1) ? 'Admin' : 'Moderator' }}</td>
                                    <td>{{ $user->birthday }}</td>
                                    <td class="center">
                                        <a href="admin/users/{{$user->id}}/edit/"><i class="fas fa-edit"></i></a>
                                        <form action="{{route('users.destroy',$user->id)}}" method="post">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            @method('delete')
                                            <button type="submit" style="background-color:transparent;border:transparent;color: #3287b2;"><i class="fa fa-trash-o  fa-fw"></i></button>
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

