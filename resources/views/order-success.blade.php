@extends('layouts.app')

@section('styles')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4 class="panel-title">Berhasil melakukan pemesanan</h4></div>

                <div class="panel-body text-center">
                    <h3>Terimakasih !!</h3>
                    <h4>Telah melakukan pemesanan makanan katering melalui <a href="{{ url('/') }}"><strong><u>KATERING APP.</u></strong></a></h4>
                    <br>
                    <p>
                        Silahkan menunggu beberapa saat ya, sampai kami memverifikasi pesanan kamu. <br>
                    </p>
                    <p>
                        Silahkan kunjungi halaman <strong><u>Pesanan</u></strong> untuk melihat status pesanan kamu. <br>
                        Atau bisa juga dengan klik tombol <span class="text-primary"><strong>CEK PEMESANAN</strong></span> yang ada dibawah. Kamu akan diarahkan ke halaman <strong><u>Pesanan</u></strong>.
                    </p>
                    <br>
                </div>

                <div class="panel-footer">
                    <a href="{{ route('listOrder') }}" class="btn btn-primary pull-right">Cek Pemesanan <i class="fa fa-fw fa-arrow-right" aria-hidden="true"></i></a>
                    <a href="{{ url('/home') }}" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali pilih Menu</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
