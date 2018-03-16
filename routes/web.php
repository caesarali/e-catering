<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['auth', 'role:customer']], function () {
	Route::resource('/profile', 'ProfileController');
	Route::get('/order/{id}', 'OrderController@getOrder')->name('getOrder');
	Route::post('/order', 'OrderController@postOrder')->name('postOrder');
	Route::get('/order-list', 'OrderController@listOrder')->name('listOrder');
	Route::get('/order/{id}/detail', 'OrderController@detailOrder')->name('detailOrder');
	Route::post('/order/{id}/cancel', 'OrderController@cancelOrder')->name('cancelOrder');
	Route::get('/order-success', 'OrderController@successOrder')->name('successOrder'); 
});


Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
	Route::get('/login', 'LoginController@showLoginForm')->name('getLogin');
	Route::post('/login', 'LoginController@login')->name('postLogin');
	Route::post('/logout', 'LoginController@logout')->name('logout-admin');
	Route::group(['middleware' => ['role:admin']], function () {

		Route::get('/', 'HomeController@index');
		Route::get('/blank', 'HomeController@blank');
		Route::get('/404', function () {
			return view('dashboard.404');
		})->name('404');

		// Order Route
		Route::get('/order/all', 'OrderController@index')->name('all-order');
		Route::get('/order/pending', 'OrderController@pending')->name('pending-order');
		Route::get('/order/{id}/detail', 'OrderController@detail')->name('detail-order');
		Route::post('/order/{id}/verify', 'OrderController@verify')->name('verify-order');
		Route::post('/order/{id}/remove', 'OrderController@remove')->name('remove-order');

		// Customer Route
		Route::resource('customer', 'CustomerController');

		// Menu Route
		Route::resource('food-menu', 'MenuController');
	});
});

