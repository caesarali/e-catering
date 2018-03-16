@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <h2 class="page-header">
                <strong>Menu Makanan Katering</strong>
            </h2>
            <div class="row">
                @foreach ($menus as $menu)
                    <div class="col-md-4">
                        <div class="panel panel-default card">
                            <div class="panel-heading">
                                <img src="{{ asset('assets/pictures/menu/'.$menu->pict) }}" class="img-responsive center-block" style="height: 180px">
                            </div>
                            <div class="panel-body">
                                <h4>{{ $menu->name }}</h4>
                                <p><strong>Harga : </strong> Rp. {{ number_format($menu->price,0,',','.') }},- / Porsi</p>
                                <p>
                                    <a href="javascript:void(0);" data-toggle="popover" title="Description" data-placement="bottom" data-content="{{ $menu->description }}">
                                        <strong>Lihat deskripsinya Kak! <i class="fa fa-caret-down fa-fw" aria-hidden="true"></i></strong>     
                                    </a>
                                </p>
                                <hr>
                                <div class="text-right">
                                    <form>
                                        <a href="{{ route('getOrder', $menu->id) }}" class="btn btn-primary">Pesan Sekarang <i class="fa fa-fw fa-chevron-circle-right"></i></a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row text-center">
                {{ $menus->links() }}
            </div>
        </div>  
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('[data-toggle="popover"]').popover();
        });
    </script>
@endsection
