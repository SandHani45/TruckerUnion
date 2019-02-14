<?php

Auth::routes();
 
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/help', function () {
	return view('pages.help');
});

Route::get('/policy', function () {
	return view('pages.policy');
});

 // VerifyToken Routes...
Route::get('verifyEmailFirst', 'Auth\RegisterController@verifyEmailFirst')
    ->name('verifyEmailFirst');
Route::get('verify/{email}/{verifyToken}', 'Auth\RegisterController@sendEmailDone')
    ->name('sendEmailDone');

Route::group(['middleware' => 'web'], function () {

    Route::get('/', function () {
    return redirect('home');
	});
    Route::resource('drop_points', 'DropPointController');
    // Route::resource('groups', 'GroupController');
    // Route::resource('group-member', 'GroupMemberController');
});
 
/*ADMIN ROUTES*/
Route::group(['namespace' =>'Admin'],function(){

    // Authentication Routes...
    Route::get('admin-login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('admin-login', 'Auth\LoginController@login');
    Route::post('admin-logout', 'Auth\LoginController@logout')->name('admin.logout');

    // Registration Routes...
    // $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    // $this->post('register', 'Auth\RegisterController@register');

    // Password Reset Routes...
    Route::get('admin/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('admin/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('admin/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('admin/password/reset', 'Auth\ResetPasswordController@reset');

    Route::get('admin/home', 'HomeController@index')->name('admin.home');
    Route::resource('admin/all-drop-points', 'AllDropPointController');
    Route::resource('admin/my-drop-points', 'MyDropPointController');
    Route::resource('admin/groups', 'GroupController');
    Route::resource('admin/group-member', 'GroupMemberController');

});
		