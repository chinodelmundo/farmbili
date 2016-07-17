<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {

	Route::get('/', 'ProductController@welcome');

    Route::auth();

    //search
	Route::get('search', 'SearchController@index');
	Route::get('search/{something}', 'SearchController@index');
	Route::post('search/products', 'SearchController@search_product')->name('search.product');
	Route::post('search/retailers', 'SearchController@search_retailer')->name('search.retailer');

	Route::post('search/products/1', 'SearchController@tryme');

	//retailers info
	Route::get('retailer/{id}', 'UserController@view_retailer')->name('retailer.view');

	Route::post('guest/buy', 'ProductController@guest_buy')->name('guest.buy');
	Route::post('guest/deal', 'ProductController@guest_deal')->name('guest.deal');

	// 
	// Need to be logged-in to access
	//

    Route::group(['middleware' => ['auth']], function () {

    	Route::get('home', 'HomeController@index')->name('home');

    	//profile
		Route::get('profile', 'UserController@index')->name('profile.index');
		Route::get('profile/{id}/edit', 'UserController@edit')->name('profile.edit');
		Route::put('profile/{id}', 'UserController@update')->name('profile.update');
		Route::get('profile/change_password', 'UserController@change_password')->name('profile.change_pw');
		Route::post('profile/change_password', 'UserController@post_change_password');

		//products
		Route::resource('product', 'ProductController', ['except' => ['show']]);
		Route::post('product/order', 'ProductController@product_order')->name('product.order');

		//search
		Route::post('search/buyers', 'SearchController@search_buyer')->name('search.buyer');

		//buyer info
		Route::get('buyer/{id}', 'UserController@view_buyer')->name('buyer.view');

		//admin info
		Route::get('admin/{id}', 'UserController@view_admin')->name('admin.view');

		//reports
		Route::resource('report', 'ReportController');

		//transactions
		Route::resource('transaction', 'TransactionController');
		Route::resource('cart', 'TransactionController@index');
		Route::get('product/{id}/buy', 'TransactionController@buy_product')->name('product.buy');
		Route::put('transaction/{id}/approve', 'TransactionController@approve')->name('transaction.approve');
		Route::put('transaction/{id}/unapprove', 'TransactionController@unapprove')->name('transaction.unapprove');
		Route::get('product/{id}/deal/start', 'TransactionController@deal_product')->name('transaction.deal');
		Route::post('product/deal/start', 'TransactionController@start_deal')->name('transaction.start_deal');
		Route::get('transaction/{id}/view', 'TransactionController@view_transaction')->name('transaction.view');
		Route::post('transaction/deal/add', 'TransactionController@add_deal')->name('transaction.add_deal');

		Route::get('profile/activities', 'UserController@view_activities');

		//list of admins
		Route::get('users/admins', 'UserController@list_all_admins');

		Route::post('image/upload/product', 'ImageController@upload_product_photo')->name('image.upload_product');
		Route::post('image/upload/user', 'ImageController@upload_user_photo')->name('image.upload_user');
		Route::delete('profile/image/{id}/delete', 'ImageController@destroy')->name('image.destroy');
		Route::delete('product/image/{id}/delete', 'ImageController@delete_product_image')->name('image.delete_product_image');
		Route::put('profile/image/{id}/primary', 'ImageController@set_primary')->name('image.primary');
		Route::put('product/image/{id}/primary', 'ImageController@set_primary_product_image')->name('image.primary_product');

		// rate retailer
		Route::post('retailer/{retailer_id}/rate/{transaction_id}', 'RatingController@rate_retailer');

		// 
		// Need to be admin to access
		//
    	Route::group(['middleware' => ['admin']], function () {

    		//approve / unapprove retailers
			Route::put('retailer/approve/{id}', 'UserController@approve_retailer')->name('retailer.approve');
			Route::put('retailer/unapprove/{id}', 'UserController@unapprove_retailer')->name('retailer.unapprove');

			//announcements
			Route::resource('announcement', 'AnnouncementController');

			//activities
			Route::get('user/{id}/activities', 'UserController@show_user_activities')->name('activities.all');

			//lists
			Route::get('users/all', 'UserController@list_all_users')->name('list.users');
			Route::get('users/buyers', 'UserController@list_all_buyers');
			Route::get('users/retailers', 'UserController@list_all_retailers');
			Route::get('users/unapproved', 'UserController@list_all_unapproved');
			Route::get('users/{year}/{month}', 'UserController@list_users_with_date');

			Route::get('products/all', 'ProductController@list_all_products')->name('list.products');
			Route::get('products/type/{animal_type}', 'ProductController@list_all_products_with_type');
			Route::get('products/{year}/{month}', 'ProductController@list_products_with_date');

			Route::get('transactions/all', 'TransactionController@index')->name('list.transactions');
			Route::get('transactions/type/{status_type}', 'TransactionController@list_transactions_with_type');
			Route::get('transactions/{year}/{month}', 'TransactionController@list_transactions_with_date');

			Route::get('email/create', 'UserController@create_email')->name('email.create');
			Route::post('email/send', 'UserController@send_email')->name('email.send');

		});
	});

	//product info (must be placed after the ProductController resource route)
	Route::get('product/{id}', 'ProductController@show')->name('product.show');
});
