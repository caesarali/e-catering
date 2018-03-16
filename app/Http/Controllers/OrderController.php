<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Order;
use Carbon\Carbon;
use Auth;

class OrderController extends Controller
{
    public function getOrder($id) {
    	$menu = Menu::find($id);
    	$date = Carbon::now();
    	return view('order', compact('menu', 'date'));
    }

    public function postOrder(Request $request) {
    	$menu = Menu::find($request->menu_id);
    	$total = $menu->price * $request->qty;
    	$date_time = date('Y-m-d H:i:s', strtotime($request->for_date .' '. $request->for_time));

    	$order = new Order;
    	$order->user_id = Auth::id();
    	$order->menu_id = $request->menu_id;
    	$order->qty = $request->qty;
    	$order->total = $total;
    	$order->order_for = $date_time;
    	$order->delivery = $request->deliver;
    	if ($request->deliver == '1') {
    		$order->to_addr = $request->to_addr;
    	}
    	$order->status = 0;
    	$order->save();
    	return redirect()->route('successOrder');
    }

    public function listOrder() {
        $orders = Order::where('status', '!=', 2)->where('user_id', Auth::id())->orderBy('updated_at', 'DESC')->get();
        return view('order-list', compact('orders'));
    }

    public function detailOrder($id) {
    	$order = Order::find($id);
    	return view('order-detail', compact('order'));
    }

    public function cancelOrder(Request $request, $id) {
        $order = Order::destroy($request->id);
        return redirect()->route('listOrder')->with('message', 'Sesuai permintaan kamu, Pesanan kami batalkan. Terimakasih, Silahkan lakukan pemesanan kembali.');
    }

    public function successOrder() {
        return view('order-success');
    }
}
