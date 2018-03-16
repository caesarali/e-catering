@extends('dashboard.layouts.app')

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        {{-- Page Header --}}
        <section class="content-header">
            <h1>
                Customer Profile
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#"><i class="fa fa-user"></i> Customer</a></li>
                <li class="active">Profile</li>
            </ol>
        </section>

        {{-- Page Content --}}
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="{{ !empty($customer->profile->pictures) ? asset('assets/pictures/profile/'.$customer->profile->pictures) : asset('assets/pictures/profile.jpg') }}" alt="User profile picture">

                            <h3 class="profile-username text-center">{{ $customer->name }}</h3>

                            <p class="text-muted text-center">{{ $customer->email }}</p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Join at</b> <a class="pull-right">{{ $customer->created_at->format('d M Y') }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Total Ordered</b> <a class="pull-right"><span class="badge">{{ $customer->order->count() }}</span></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Phone / WA</b> <a class="pull-right">{{ $customer->profile->phone or 'Not available' }}</a>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <b>Address</b>
                                        </div>
                                        <div class="col-md-9 text-right">
                                            <a class="">{{ $customer->profile->address or 'Not available' }}</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <a href="#" class="btn btn-danger btn-block" onclick="document.getElementById('remove-user').submit();"><b>DELETE THIS ACCOUNT</b></a>
                            <form id="remove-user" action="{{ route('customer.destroy', $customer->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Customer Order History</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <table id="ordered-table" class="table table-bordered table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order at</th>
                                        <th>Menu</th>
                                        <th>QTY</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $x = 1; @endphp
                                    @foreach($customer->order as $order)
                                        <tr>
                                            <td><strong>{{ $x++ }}.</strong></td>
                                            <td>{{ $order->created_at->format('H:i - d M Y') }}</td>
                                            <td>{{ $order->menu->name }}</td>
                                            <td>{{ $order->qty }} Porsi</td>
                                            <td>Rp. {{ number_format($order->total,0,',','.') }}</td>
                                            <td>
                                                @if ($order->status == 0)
                                                    <label class="label label-warning">Menunggu Verifikasi</label>
                                                @elseif ($order->status == 1)
                                                    <label class="label label-info">Diverifikasi</label>
                                                @elseif ($order->status == 2)
                                                    <label class="label label-success">Complete</label>
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
        </section>
    </div>
@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{ asset('assets/dashboard/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            $('#ordered-table').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : false,
                'info'        : false,
                'autoWidth'   : false
            });
        })
    </script>
@endsection