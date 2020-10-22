<?php
use Illuminate\Support\Facades\Route;


Route::get('/', 'HomeController@login')->name('/');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/paymnet/pricing', 'HomeController@paymnet_pricing')->name('paymnet.pricing');
Route::post('/paymnet/okay', 'HomeController@paymnet_okay');
Route::post('/user/profile/update', 'HomeController@profile_update')->name('profile.update');
Route::get('/lawer/register', 'HomeController@lawer_register')->name('lawer.register');
Route::post('/lawer/register', 'HomeController@lawer_register_save')->name('lawer.register');
Route::resource('hire','HareController');
Route::any('verification/pay/success','VerificationController@success_pay')->name('verification.pay.success');
Route::any('verification/pay/fail','VerificationController@fail_pay')->name('verification.pay.fail');

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
	Route::get('/post', 'LawyerController@post')->name('lawyer.post');
	Route::get('/post/{id}', 'LawyerController@post_show')->name('lawyer.post.show');
	Route::post('/post/bit', 'LawyerController@bit')->name('lawyer.bit');
	Route::get('/hire', 'HareController@lawyer_hire')->name('lawyer.hire');
	Route::get('/hire/{id}', 'HareController@lawyer_hire_view')->name('lawyer.hire.view');

});

// Client Route
Route::group(['prefix' =>'client','middleware'=>['auth']], function(){
	Route::get('/dashboard', 'HomeController@client_dashboard')->name('client.dashboard');
	Route::get('/find/lawyer', 'ClientController@lawyer')->name('client.lawyer');
	Route::get('/find/lawyer/{id}', 'ClientController@lawyer_view')->name('client.lawyer.view');
	Route::resource('post','PostController');
	Route::resource('case','CasController');
});

Route::group(['middleware'=>['auth']], function(){
	Route::resource('message','MessageController');
	Route::post('message/user','MessageController@user')->name('message.user');
	Route::post('message/send','MessageController@send')->name('message.send');
	Route::get('message/details/{id}','MessageController@details')->name('message.details');
	Route::get('/profile', 'HomeController@profile')->name('profile');
	Route::post('hire/payment','HareController@harepayment')->name('hire.payment');
	Route::resource('verification','VerificationController');
	Route::any('verification/pay','VerificationController@verification_pay')->name('verification_pay');
	Route::resource('helppost','HelpPostController');
	Route::post('help/post/comment','HelpPostController@comment')->name('help.post.comment');
	Route::post('hire/details/store', 'HareController@hire_details_store')->name('lawyer.hire.details.store');
});
