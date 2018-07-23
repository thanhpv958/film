@extends('admin.layout.main')

@section('content')

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Danh sách giá vé</h3>
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
                            <th>Thông tin vé</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $stt=1 @endphp
                        @foreach ($theaters as $theater)
                            <tr class="odd gradeX" align="center">
                                <td>{{ $stt++ }}</td>
                                <td>{{ $theater->name }}</td>
                                <td class="text-left">
                                    @foreach ($theater->ticketPrices as $ticketPrice)
                                        <div>
                                            <span style="display:inline-block;width: 150px; font-size: 15px;"> {{ $ticketPrice->type }} - {{ number_format($ticketPrice->price_per_ticket, 0) }} {{ 'VND' }}</span>

                                            {!! Form::open(['method' => 'GET', 'url' => "admin/ticketprices/$ticketPrice->id/edit", 'style' => 'display: inline-block;']) !!}
                                                {!!  Form::button('<i class="fas fa-edit"></i>', ['class' => 'btn btn-primary', 'style' => 'padding:2px', 'type' => 'submit']) !!}
                                            {!! Form::close() !!}

                                            {!! Form::open(['method' => 'DELETE', 'url' => "admin/ticketprices/$ticketPrice->id", 'style' => 'display: inline-block;']) !!}
                                                {!!  Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-danger', 'style' => 'padding:2px', 'type' => 'submit']) !!}
                                            {!! Form::close() !!}
                                        </div>

                                        <br>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
            </table>

            <a href="{{url('admin/ticketprices/create')}}" class="btn btn-primary">Thêm giá vé</a>
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

