@extends('admin.layout.main')

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
                            <th>Phim</th>
                            <th>Rạp chiếu</th>
                            <th>Xuất chiếu</th>
                            <th>Ghế</th>
                            <th>Ngày đặt</th>
                            <th>Tài khoản đặt</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php ($stt=1)
                        @foreach ($tk as $ticket)
                            <tr class="odd gradeX" align="center">
                                <td>{{ $stt++ }}</td>
                                <td>{{ $ticket->calendar->film->name }}</td>
                                <td>{{ $ticket->calendar->room->theater->name }}</td>
                                <td>{{ $ticket->calendar->calendarTimes[0]->time_show .' - '.$ticket->calendar->date_show }}</td>
                                <td>
                                    @foreach ($ticket->seats as $seat)
                                        {{ $loop->first ? '' : ',' }}
                                        {{ $seat->name }}
                                    @endforeach
                                </td>
                                <td>{{ $ticket->created_at }}</td>
                                <td>{{ $ticket->user->name }}</td>
                                <td class="text-center">
                                    <form action="admin/user-tickets/{{ $ticket->id }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                       <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
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
