<div class="row">
    <div class="col-md-5">
        <img src="{{ asset('assets/pictures/menu/'.$order->menu->pict) }}" class="img-responsive" style="margin-bottom: 20px">
    </div>
    <div class="col-md-7">
        <div class="row">
            <div class="col-md-4">
                <strong>Customer</strong>
            </div>
            <div class="col-md-8">
                : {{ $order->user->name }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <strong>Menu</strong>
            </div>
            <div class="col-md-8">
                : {{ $order->menu->name }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <strong>QTY</strong>
            </div>
            <div class="col-md-8">
                : {{ $order->qty }} Porsi
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <strong>Date Time</strong>
            </div>
            <div class="col-md-8">
                : {{ date('d M Y - H:i', strtotime($order->order_for)) }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <strong>Delivery</strong>
            </div>
            <div class="col-md-8">
                : 
                @if ($order->delivery == 1)
                    <label class="label label-success"> Yes </label>
                @else 
                    <label class="label label-danger"> No </label>
                @endif
            </div>
        </div>
        @if ($order->delivery == 1)
            <div class="row">
                <div class="col-md-4">
                    <strong>Address</strong>
                </div>
                <div class="col-md-8">
                    : {{ $order->to_addr }}
                </div>
            </div>
        @endif
        <hr>
        <div class="row">
            <div class="col-md-4">
                <strong>Total</strong>
            </div>
            <div class="col-md-8">
                : Rp. {{ number_format($order->total,0,',','.') }},-
            </div>
        </div>
    </div>
</div>