@extends('be.layout.layout')
@section('title', 'Income')

@section('style-section')
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Products table</h3>
                    </div>

                    <div class="card-body">
                        <table id="income" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Date Complete</th>
                                    <th>Order ID</th>
                                    <th>Order Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $o)
                                    <tr>
                                        <td>
                                            <div>Updated: {{ $o->updated_at }}</div>
                                        </td>
                                        <td>{{ $o->id }}</td>
                                        <td>${{ $o->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- <canvas id="myChart" width="400" height="400"></canvas> --}}
    </section>
@endsection

@section('script-section')
    <script>
        $(function() {
            $('#income').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "order": [
                    [0, 'desc']
                ],
                "info": true,
                "autoWidth": false,
            });
        }());
    </script>
@endsection
