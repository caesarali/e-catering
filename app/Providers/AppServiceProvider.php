<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $count0 = 0;
        $count1 = 0;

        // $orders = Schema::hasTable('order');
        // if ($orders) {
        //     $count0 = DB::table('order')->where('status', 0)->count();
        //     $count1 = DB::table('order')->where('status', 1)->count();
        // }

        View::share(['count0' => $count0, 'count1' => $count1]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
