<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/', 'HomeController@redirectAdminDashboard')->name('index');
Route::get('/home', 'HomeController@index')->name('home');

// SUPER ADMIN ROUTE...
Route::group(['prefix' => 'admins', 'namespace' => 'Backend', 'as' => 'admin.'], function (){
    // ADMINS LOGIN ROUTE...
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    // ADMINS LOGOUT ROUTES...
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    // ADMINS FORGET PASSWORD...
    Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/reset', 'Auth\ForgotPasswordController@reset')->name('password.update');

    // DASHBOARD ROUTE...
    Route::get('/', 'DashboardController@index')->name('index');
    // ROLES ROUTE...
    Route::resource('roles', 'RolesController');
    // USERS ROUTE...
    Route::resource('users', 'UsersController');
    // ADMINS ROUTE...
    Route::resource('admins', 'AdminsController');

});
