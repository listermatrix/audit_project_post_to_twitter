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

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;



Route::get('/', 'FormController@audit_table')->name('home.index');
Route::get('/twitter', 'MediaController@connect_twitter')->name('media.twitter');
Route::get('/twitter/cbk', 'MediaController@twitter_cbk')->name('media.cbk');
Route::post('/twitter/post', 'MediaController@index')->name('media.twitter.post');













Route::get('login','Auth\LoginController@getLogin')->name('login');
Route::post('login','Auth\LoginController@auth_check')->name('post.login');
Route::get('logout','Auth\LoginController@loggedOut')->name('logout');
