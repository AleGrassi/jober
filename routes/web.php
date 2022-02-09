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

//authentication
Auth::routes(); //auth scaffold
Route::get('/user/login',['as'=>'user.login', 'uses'=>'\App\Http\Controllers\AuthController@authentication']);
Route::post('/user/login',['as'=>'user.login', 'uses'=>'\App\Http\Controllers\AuthController@login']);
Route::get('/user/logout',['as'=>'user.logout', 'uses'=>'\App\Http\Controllers\AuthController@logout']);
Route::post('/user/register',['as'=>'user.register', 'uses'=>'\App\Http\Controllers\AuthController@registration']);

Route::group(['middleware'=>['language']], function(){
    //company
    Route::get('/company',['as'=>'company.index', 'uses'=>'\App\Http\Controllers\CompanyController@index']);
    Route::get('/company/{company}',['as'=>'company.show', 'uses'=>'\App\Http\Controllers\CompanyController@show']);
    Route::group(['middleware'=>['authCustom']], function(){
        Route::get('/company/create',['as'=>'company.create', 'uses'=>'\App\Http\Controllers\CompanyController@create']);
        Route::post('/company',['as'=>'company.store', 'uses'=>'\App\Http\Controllers\CompanyController@store']);
        Route::get('/company/{company}/edit',['as'=>'company.edit', 'uses'=>'\App\Http\Controllers\CompanyController@edit']);
        Route::get('/company/{company}/destroy',['as'=>'company.destroy', 'uses'=>'\App\Http\Controllers\CompanyController@destroy']);
        Route::post('/company/{company}/update',['as'=>'company.update', 'uses'=>'\App\Http\Controllers\CompanyController@update']);
    });

    //worker
    Route::get('/worker',['as'=>'worker.index', 'uses'=>'\App\Http\Controllers\WorkerController@index']);
    Route::get('/worker/{worker}',['as'=>'worker.show', 'uses'=>'\App\Http\Controllers\WorkerController@show']);
    Route::group(['middleware'=>['authCustom']], function(){
        Route::get('/worker/create',['as'=>'worker.create', 'uses'=>'\App\Http\Controllers\WorkerController@create']);
        Route::post('/worker',['as'=>'worker.store', 'uses'=>'\App\Http\Controllers\WorkerController@store']);
        Route::get('/worker/{worker}/edit',['as'=>'worker.edit', 'uses'=>'\App\Http\Controllers\WorkerController@edit']);
        Route::get('/worker/{worker}/destroy',['as'=>'worker.destroy', 'uses'=>'\App\Http\Controllers\WorkerController@destroy']);
        Route::post('/worker/{worker}/update',['as'=>'worker.update', 'uses'=>'\App\Http\Controllers\WorkerController@update']);
        Route::get('/worker/{worker}/contact',['as'=>'worker.contact', 'uses'=>'\App\Http\Controllers\WorkerController@contact']);
    });

    //offer
    Route::get('/offer',['as'=>'offer.index', 'uses'=>'\App\Http\Controllers\OfferController@index']);
    Route::get('/offer/{offer}',['as'=>'offer.show', 'uses'=>'\App\Http\Controllers\OfferController@show']);
    Route::group(['middleware'=>['authCustom']], function(){
        Route::get('/offer/create',['as'=>'offer.create', 'uses'=>'\App\Http\Controllers\OfferController@create']);
        Route::post('/offer',['as'=>'offer.store', 'uses'=>'\App\Http\Controllers\OfferController@store']);
        Route::get('/offer/{offer}/edit',['as'=>'offer.edit', 'uses'=>'\App\Http\Controllers\OfferController@edit']);
        Route::get('/offer/{offer}/destroy',['as'=>'offer.destroy', 'uses'=>'\App\Http\Controllers\OfferController@destroy']);
        Route::post('/offer/{offer}/update',['as'=>'offer.update', 'uses'=>'\App\Http\Controllers\OfferController@update']);
        Route::get('/offer/{offer}/{worker}/reject',['as'=>'offer.reject', 'uses'=>'\App\Http\Controllers\OfferController@rejectCandidate']);
        Route::get('/application/candidate', '\App\Http\Controllers\OfferController@candidate');
        Route::get('/application/check', '\App\Http\Controllers\OfferController@ajaxCheckForWorker');
    });

    //language change
    Route::get('/lang/{lang}', ['as'=>'lang.change', 'uses'=>'\App\Http\Controllers\LangController@changeLanguage']);

    //root
    Route::get('/',['as'=>'home', 'uses'=>'\App\Http\Controllers\FrontController@getHome']);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});