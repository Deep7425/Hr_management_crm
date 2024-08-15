<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



Auth::routes(['verify' => true, 'register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', function () {
        return redirect()->route('admin.login');
    });

    // login route
    Route::POST('logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::POST('login', 'Auth\LoginController@login')->name('login');
    Route::get('enquiry','EnquirieController@index');

    //Route::get('enquiry','EnquirieController@index')->name('enquiry.index');

    //login route
     Route::get('enquiry/show','EnquirieController@show'); 

   
    // Route::post('enquiry/store','EnquirieController@store')->name('enquiry.store');      
    // Route::get('enquiry/edit','EnquirieController@edit')->name('enquiry.edit');          
    // Route::post('enquiry/update','EnquirieController@update')->name('enquiry.update');     
    // Route::get('enquiry/show','EnquirieController@show')->name('enquiry.show');       
    // Route::get('enquiry/status','EnquirieController@status')->name('enquiry.status');
    // Route::get('enquiry/delete','EnquirieController@destroy')->name('enquiry.delete');

     
    
});
