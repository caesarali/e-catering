@extends('dashboard.layouts.app')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- PNotify -->
    <link href="{{ asset('assets/pnotify/dist/pnotify.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="content-wrapper">
        {{-- Page Header --}}
        <section class="content-header">
            <h1> Customers </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Customer</li>
            </ol>
        </section>

        {{-- Page Content --}}
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">All Data Customers</h3>
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
                    <table id="customer-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Join At</th>
                                <th>Total Order Count</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $x = 1; @endphp
                            @foreach($users as $user)
                                @if($user->hasRole('customer'))
                                    <tr>
                                        <td><strong>{{ $x++ }}.</strong></td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                        <td>{{ $user->order->count() }} kali</td>
                                        <td class="text-right"  style="width: 180px;">
                                            <a href="{{ route('customer.show', $user->id) }}" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-user"></i> <strong>PROFILE</strong></a>
                                            <button class="btn btn-danger btn-sm btn-flat" onclick="document.getElementById('remove-user-{{ $user->id }}').submit();"><i class="fa fa-times"></i> <strong>DELETE</strong></button>
                                            <form id="remove-user-{{ $user->id }}" action="{{ route('customer.destroy', $user->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
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
    <script>
        $(function () {
            $('#customer-table').DataTable()
        })

        @if (session('message'))
            $(function () {
                new PNotify({
                    title: 'Success',
                    text: '{{ session('message') }}',
                    type: 'success',
                    hide: true,
                    styling: 'bootstrap3',
                });
            });
        @endif
    </script>
@endsection