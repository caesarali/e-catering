@extends('layouts.app')

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- PNotify -->
    <link href="{{ asset('assets/pnotify/dist/pnotify.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet">
    <style type="text/css">
        #modal-detail .row {
            margin-bottom: 5px
        }

        #modal-detail hr {
            margin: 10px 0;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Keterangan Status</h3>
                    </div>
                    <div class="panel-body">
                        <ul>
                            <li>
                                <label class="label label-warning">Menunggu verifikasi</label> <i class="fa fa-long-arrow-right hidden-xs" aria-hidden="true"></i> 
                                <label> Pesanan sedang kami cek, apakah bisa diterima atau tidak.</label>
                            </li>
                            <li>
                                <label class="label label-info">Pesanan diterima</label> <i class="fa fa-long-arrow-right hidden-xs" aria-hidden="true"></i> 
                                <label>Pesanan sudah kami terima, dan sedang kami buatkan. Pesanan juga bisa diantar/diambil sesuai dengan permintaan kamu.</label>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Daftar Pesanan</h4>
                    </div>
                    <div class="panel-body">
                        <table id="table-order" class="table table-responsive table-striped">
                            <thead>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Pesanan</th>
                                <th>QTY</th>
                                <th>Status</th>
                                <th>Total Bayar</th>
                                <th>Opsi</th>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $i++ }}.</td>
                                        <td>{{ $order->created_at->format('d M, Y') }}</td>
                                        <td>{{ $order->menu->name }}</td>
                                        <td>{{ $order->qty }} Porsi</td>
                                        <td>
                                            @if ($order->status == 0)
                                                <label class="label label-warning">Menunggu verifikasi</label>
                                            @elseif ($order->status == 1)
                                                <label class="label label-info">Pesanan diterima</label>
                                            @endif
                                        </td>
                                        <td> Rp. {{ number_format($order->total,0,',','.') }},-</td>
                                        <td class="text-center">
                                            @if ($order->status == 0)
                                                <button class="btn btn-primary btn-sm btn-detail" data-toggle="modal" data-target="#modal-detail" data-route="{{ route('detailOrder', $order->id) }}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm" onclick="document.getElementById('cancel-order-{{ $order->id }}').submit();"><i class="fa fa-times"></i></button>
                                                <form id="cancel-order-{{ $order->id }}" method="POST" action="{{ route('cancelOrder', $order->id) }}">
                                                    {{ csrf_field() }}
                                                </form>
                                            @else
                                                <button class="btn btn-primary btn-sm btn-detail" data-toggle="modal" data-target="#modal-detail" data-route="{{ route('detailOrder', $order->id) }}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm" disabled="disabled"><i class="fa fa-times"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Modal -->
            <div id="modal-detail" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="panel-title">Detail pesanan</h3>
                        </div>
                        <div class="panel-body">
                        {{-- Content --}}
                        </div>
                        <div class="panel-footer">
                            <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Ok. Tutup.</button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{ asset('assets/dashboard/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- PNotify -->
    <script src="{{ asset('assets/pnotify/dist/pnotify.js') }}"></script>
    <script src="{{ asset('assets/pnotify/dist/pnotify.buttons.js') }}"></script>
    <script src="{{ asset('assets/pnotify/dist/pnotify.nonblock.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-order').DataTable();
        });

        $('.btn-detail').click(function(event) {
            $.get($(this).data('route'), function(data) {
                $('#modal-detail .panel-body').html(data)
            });
        });

        @if (session('message'))
            $(function () {
                new PNotify({
                    title: 'Sukses.',
                    text: '{{ session('message') }}',
                    type: 'success',
                    hide: true,
                    styling: 'bootstrap3',
                });
            });
        @endif
    </script>
@endsection
