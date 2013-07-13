<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Register all the admin routes.
|
*/

Route::group(array('prefix' => 'admin'), function()
{

	# want Management
	Route::group(array('prefix' => 'wants'), function()
	{
		Route::get('/', array('as' => 'wants', 'uses' => 'Controllers\Admin\WantsController@getIndex'));
		Route::get('create', array('as' => 'create/want', 'uses' => 'Controllers\Admin\WantsController@getCreate'));
		Route::post('create', 'Controllers\Admin\WantsController@postCreate');
		Route::get('{wantId}/edit', array('as' => 'update/want', 'uses' => 'Controllers\Admin\WantsController@getEdit'));
		Route::post('{wantId}/edit', 'Controllers\Admin\WantsController@postEdit');
		Route::get('{wantId}/delete', array('as' => 'delete/want', 'uses' => 'Controllers\Admin\WantsController@getDelete'));
		Route::get('{wantId}/restore', array('as' => 'restore/want', 'uses' => 'Controllers\Admin\WantsController@getRestore'));
	});
	
	# Can Management
	Route::group(array('prefix' => 'cans'), function()
	{
		Route::get('/', array('as' => 'cans', 'uses' => 'Controllers\Admin\CansController@getIndex'));	
		Route::get('create', array('as' => 'create/can', 'uses' => 'Controllers\Admin\CansController@getCreate'));
		Route::post('create', 'Controllers\Admin\CansController@postCreate');
		Route::get('{canId}/edit', array('as' => 'update/can', 'uses' => 'Controllers\Admin\CansController@getEdit'));
		Route::post('{canId}/edit', 'Controllers\Admin\CansController@postEdit');
		Route::get('{canId}/delete', array('as' => 'delete/can', 'uses' => 'Controllers\Admin\CansController@getDelete'));
		Route::get('{canId}/restore', array('as' => 'restore/can', 'uses' => 'Controllers\Admin\CansController@getRestore'));
	});

	# User Management
	Route::group(array('prefix' => 'users'), function()
	{
		Route::get('/', array('as' => 'users', 'uses' => 'Controllers\Admin\UsersController@getIndex'));
		Route::get('create', array('as' => 'create/user', 'uses' => 'Controllers\Admin\UsersController@getCreate'));
		Route::post('create', 'Controllers\Admin\UsersController@postCreate');
		Route::get('{userId}/edit', array('as' => 'update/user', 'uses' => 'Controllers\Admin\UsersController@getEdit'));
		Route::post('{userId}/edit', 'Controllers\Admin\UsersController@postEdit');
		Route::get('{userId}/delete', array('as' => 'delete/user', 'uses' => 'Controllers\Admin\UsersController@getDelete'));
		Route::get('{userId}/restore', array('as' => 'restore/user', 'uses' => 'Controllers\Admin\UsersController@getRestore'));
	});

	# Group Management
	Route::group(array('prefix' => 'groups'), function()
	{
		Route::get('/', array('as' => 'groups', 'uses' => 'Controllers\Admin\GroupsController@getIndex'));
		Route::get('create', array('as' => 'create/group', 'uses' => 'Controllers\Admin\GroupsController@getCreate'));
		Route::post('create', 'Controllers\Admin\GroupsController@postCreate');
		Route::get('{groupId}/edit', array('as' => 'update/group', 'uses' => 'Controllers\Admin\GroupsController@getEdit'));
		Route::post('{groupId}/edit', 'Controllers\Admin\GroupsController@postEdit');
		Route::get('{groupId}/delete', array('as' => 'delete/group', 'uses' => 'Controllers\Admin\GroupsController@getDelete'));
		Route::get('{groupId}/restore', array('as' => 'restore/group', 'uses' => 'Controllers\Admin\GroupsController@getRestore'));
	});

	# Dashboard
	Route::get('/', array('as' => 'admin', 'uses' => 'Controllers\Admin\DashboardController@getIndex'));

});

/*
|--------------------------------------------------------------------------
| Authentication and Authorization Routes
|--------------------------------------------------------------------------
|
|
|
*/

Route::group(array('prefix' => 'auth'), function()
{

	# Login
	Route::get('signin', array('as' => 'signin', 'uses' => 'AuthController@getSignin'));
	Route::post('signin', 'AuthController@postSignin');

	# Register
	Route::get('signup', array('as' => 'signup', 'uses' => 'AuthController@getSignup'));
	Route::post('signup', 'AuthController@postSignup');

	# Account Activation
	Route::get('activate/{activationCode}', array('as' => 'activate', 'uses' => 'AuthController@getActivate'));

	# Forgot Password
	Route::get('forgot-password', array('as' => 'forgot-password', 'uses' => 'AuthController@getForgotPassword'));
	Route::post('forgot-password', 'AuthController@postForgotPassword');

	# Forgot Password Confirmation
	Route::get('forgot-password/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'AuthController@getForgotPasswordConfirm'));
	Route::post('forgot-password/{passwordResetCode}', 'AuthController@postForgotPasswordConfirm');

	# Logout
	Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));

});

Route::get('social/{action}', array("as" => "hybridauth", 'uses' => 'HauthController@getSignin'));

/*
|--------------------------------------------------------------------------
| Account Routes
|--------------------------------------------------------------------------
|
|
|
*/
Route::group(array('prefix' => 'account'), function()
{

	# want Management
	Route::group(array('prefix' => 'wants'), function()
	{
		
		Route::get('create', array('as' => 'create/want', 'uses' => 'Controllers\Account\WantsController@getCreate'));
		Route::post('create', 'Controllers\Account\WantsController@postCreate');
	});
	
	# Can Management
	Route::group(array('prefix' => 'cans'), function()
	{		
		Route::get('create', array('as' => 'create/can', 'uses' => 'Controllers\Account\CansController@getCreate'));
		Route::post('create', 'Controllers\Account\CansController@postCreate');
		
	});

	# Account Dashboard
	Route::get('/', array('as' => 'account', 'uses' => 'Controllers\Account\DashboardController@getIndex'));

	# Profile
	Route::get('profile', array('as' => 'profile', 'uses' => 'Controllers\Account\ProfileController@getIndex'));
	Route::post('profile', 'Controllers\Account\ProfileController@postIndex');

	# Change Password
	Route::get('change-password', array('as' => 'change-password', 'uses' => 'Controllers\Account\ChangePasswordController@getIndex'));
	Route::post('change-password', 'Controllers\Account\ChangePasswordController@postIndex');

	# Change Email
	Route::get('change-email', array('as' => 'change-email', 'uses' => 'Controllers\Account\ChangeEmailController@getIndex'));
	Route::post('change-email', 'Controllers\Account\ChangeEmailController@postIndex');

});


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('about-us', function()
{
	//
	return View::make('frontend/about-us');
});

Route::get('contact-us', array('as' => 'contact-us', 'uses' => 'ContactUsController@getIndex'));
Route::post('contact-us', 'ContactUsController@postIndex');

Route::get('allwant', array('as' => 'allwant', 'uses' => 'WantController@getIndex'));
Route::get('want/{postSlug}', array('as' => 'view-want', 'uses' => 'WantController@getView'));
Route::post('want/{postSlug}', 'WantController@wantView');

Route::get('allcan', array('as' => 'allcan', 'uses' => 'CanController@getIndex'));
Route::get('can/{postSlug}', array('as' => 'view-can', 'uses' => 'CanController@getView'));
Route::post('can/{postSlug}', 'CanController@canView');

Route::get('user/{userid}', array('as' => 'user', 'uses' => 'UserController@getUser'));

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@getIndex'));

Route::get('feed', array('uses' => 'FeedController@getIndex' ));
Route::get('sitemap', array('uses' => 'SitemapController@getIndex' ));

# API Resurce
Route::group(array('prefix' => 'api/v1'), function()
{
	//Route::get('create', array('as' => 'create/want', 'uses' => 'Controllers\Account\WantsController@getCreate'));
	//Route::post('create', 'Controllers\Account\WantsController@postCreate');
	Route::resource('want', 'ApiWantsController');
});