<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use App\User;
use App\Order;

class HomeController extends Controller
{
    public function index() {
    	$menuCount = Menu::count();
    	$userCount = User::count();
    	$pendingOrder = Order::where('status', '!=', 2)->count();
    	$completeOrder = Order::where('status', 2)->count();
    	return view('dashboard.home', compact('menuCount', 'userCount', 'pendingOrder', 'completeOrder'));
    }

    public function blank() {
    	return view('dashboard.blank');
    }
}
