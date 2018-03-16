<?php

use Illuminate\Database\Seeder;
use App\Menu;
use App\Order;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = Menu::find(9);
        $total = $menu->price * 10;
        $date_time = date('Y-m-d H:i:s');

        for ($i=1; $i <= 15; $i++) { 
            $order = new Order;
            $order->user_id = 4;
            $order->menu_id = 9;
            $order->qty = 10;
            $order->total = $total;
            $order->order_for = $date_time;
            $order->delivery = 0;
            $order->status = 0;
            $order->save();
        }

        for ($i=1; $i <= 10; $i++) { 
            $order = new Order;
            $order->user_id = 7;
            $order->menu_id = 8;
            $order->qty = 10;
            $order->total = $total;
            $order->order_for = $date_time;
            $order->delivery = 0;
            $order->status = 2;
            $order->save();
        }
    }
}
