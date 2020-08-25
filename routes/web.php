<?php
use Illuminate\Support\Facades\Route;


Route::get('/', 'HomeController@login')->name('/');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/lawer/register', 'HomeController@lawer_register')->name('lawer.register');
Route::post('/lawer/register', 'HomeController@lawer_register_save')->name('lawer.register');
Auth::routes();

// Admin Route
Route::group(['prefix' =>'admin','middleware'=>['auth','admin']], function(){
	Route::get('/dashboard', 'HomeController@admin_dashboard')->name('admin.dashboard');
	Route::get('/lawyer', 'AdminController@lawyer')->name('admin.lawyer');
	Route::get('/lawyer/{id}', 'AdminController@lawyer_view')->name('admin.lawyer.view');
});

// Lawyer Route
Route::group(['prefix' =>'lawyer','middleware'=>['auth','lawyer']], function(){
	Route::get('/dashboard', 'HomeController@lawyer_dashboard')->name('lawyer.dashboard');
});

// Client Route
Route::group(['prefix' =>'client','middleware'=>['auth']], function(){
	Route::get('/dashboard', 'HomeController@client_dashboard')->name('client.dashboard');
	Route::get('/find/lawyer', 'ClientController@lawyer')->name('client.lawyer');
	Route::get('/find/lawyer/{id}', 'ClientController@lawyer_view')->name('client.lawyer.view');
});