<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends Controller
{
    public function index() {
    	$orders = Order::where('status', 2)->orderBy('updated_at', 'DESC')->get();
    	return view('dashboard.order', compact('orders'));
    }

    public function pending() {
    	$orders = Order::where('status', '!=' , 2)->orderBy('created_at', 'DESC')->get();
    	return view('dashboard.order-pending', compact('orders'));
    }

    public function detail($id) {
    	$order = Order::find($id);
    	return view('dashboard.order-detail', compact('order'));
    }

    public function remove($id) {
        $order = Order::destroy($id);
        return redirect()->route('all-order')->with('message', 'Order has been deleted.');
    }

    public function verify(Request $request, $id) {
        if ($request->method == 'complete') {
            return $this->completetOrder($id);
        } elseif ($request->method == 'accept') {
    		return $this->acceptOrder($id);
    	} else {
    		return $this->cancelOrder($id);
    	}
    }

    private function completetOrder($id) {
        $order = Order::find($id);
        $order->status = 2;
        $order->save();
        return redirect()->route('pending-order')->with('message', 'Order has mark as completly order. Go to the Completly Order Page to see that.');
    }

    private function acceptOrder($id) {
    	$order = Order::find($id);
    	$order->status = 1;
    	$order->save();
    	return redirect()->route('pending-order')->with('message', 'Order has been accepted.');
    }

    private function cancelOrder($id) {
    	$order = Order::destroy($id);
    	return redirect()->route('pending-order')->with('message', 'OK. Order has been canceled.');
    }
}
