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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/getAllProduits', 'BlogController@getAllProduits');
Route::get('/searchProduit/{title}', 'BlogController@searchProduit');

Route::get('/searchPrice/{mini?}/{maxi?}', 'BlogController@searchPrice');
Route::get('/searchCategory/{id_category?}', 'BlogController@searchCategory');

Route::get('/searchSousCategory/{id_sous_category?}', 'BlogController@searchSousCategory');

Route::get('/searchChange/{id}', 'BlogController@searchChange');

Route::get('/getImagesProduits', 'BlogController@getImagesProduits');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
