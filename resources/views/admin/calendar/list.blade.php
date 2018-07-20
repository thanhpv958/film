@extends('admin.layout.index')

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
                            <th>Rạp</th>
                            <th>Phòng chiếu</th>
                            <th>Phim</th>
                            <th>Thời gian</th>
                            <th>Tổng số ghế</th>
                            <th>Ghế trống</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php ($stt=1)
                        @foreach ($calendars as $calendar)
                            <tr class="odd gradeX" align="center">
                                <td>{{ $stt++ }}</td>
                                <td>{{ $calendar->room->theater->name }}</td>
                                <td>{{ $calendar->room->name }}</td>
                                <td>{{ $calendar->film->name }}</td>
                                <td>
                                    <b style="font-size: 16px;">{{ $calendar->date_show }}</b>
                                    <br>
                                    @foreach ($calendar->calendarTimes as $calTime)
                                        {{ $calTime->time_show }} {{ '-' }}  {{ $calTime->type_ticket }} <br>
                                    @endforeach
                                </td>
                                <td>14</td>
                                <td>7</td>
                                <td class="center">
                                    <form action="admin/calendars/{{ $calendar->id }}/edit" method="GET" style="display: inline-block;">
                                        @csrf
                                        <button class="btn btn-info" type="submit"><i class="fas fa-edit"></i></button>
                                    </form>
                                    <form action="admin/calendars/{{ $calendar->id }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                       <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
            </table>

            <a href="admin/calendars/create" class="btn btn-primary">Thêm lịch chiếu</a>
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

