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

/* Route::get('/', function () {
    return view('index');
}); */

Route::get('/user/login',['as'=>'user.login', 'uses'=>'\App\Http\Controllers\AuthController@authentication']);
Route::post('/user/login',['as'=>'user.login', 'uses'=>'\App\Http\Controllers\AuthController@login']);
Route::get('/user/logout',['as'=>'user.logout', 'uses'=>'\App\Http\Controllers\AuthController@logout']);
Route::post('/user/register',['as'=>'user.register', 'uses'=>'\App\Http\Controllers\AuthController@registration']);


Route::resource('company','\App\Http\Controllers\CompanyController');
Route::get('/company/{id}/destroy',['as'=>'company.destroy', 'uses'=>'\App\Http\Controllers\CompanyController@destroy']);
Route::get('/company/{id}/update',['as'=>'company.update', 'uses'=>'\App\Http\Controllers\CompanyController@update']);

Route::resource('worker','\App\Http\Controllers\WorkerController');
Route::get('/worker/{id}/destroy',['as'=>'worker.destroy', 'uses'=>'\App\Http\Controllers\WorkerController@destroy']);
Route::get('/worker/{id}/update',['as'=>'worker.update', 'uses'=>'\App\Http\Controllers\WorkerController@update']);

Route::resource('offer','\App\Http\Controllers\OfferController');
Route::get('/offer/{id}/destroy',['as'=>'offer.destroy', 'uses'=>'\App\Http\Controllers\OfferController@destroy']);
Route::get('/offer/{id}/update',['as'=>'offer.update', 'uses'=>'\App\Http\Controllers\OfferController@update']);

Route::get('/',['as'=>'home', 'uses'=>'\App\Http\Controllers\FrontController@getHome']);

Route::get('/workers',['as'=>'workers',function(){
    return view('worker/workers');
}]);

Route::get('/worker-profile',['as'=>'worker-profile',function(){
    return view('worker/worker_profile');
}]);

Route::get('/off',['as'=>'off',function(){
    return view('company/offer');
}]);

Route::get('/off/edit',['as'=>'edit_offer',function(){
    return view('company/edit_offer');
}]);
/*
Route::get('/worker/edit',['as'=>'worker.edit',function(){
    return view('worker/edit_worker_profile');
}]);
*/
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
