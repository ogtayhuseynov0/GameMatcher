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

//Route::get('/', function () {
//    return view('index');
//});
Route::get('/', 'ContactMessagesController@index');
Route::post('/', 'ContactMessagesController@store');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('feed');
Route::get('/feed', 'HomeController@index')->name('feed');
Route::get('/search', 'HomeController@search')->name('search');

//club related links
Route::get('club/{id}','ClubsController@index')->middleware('auth');
Route::get('cclub','ClubsController@showcclub')->middleware('auth')->name('cclub');
Route::post('cclub','ClubsController@store')->middleware('auth')->name('cclub');
Route::get('club/{id}/edit','ClubsController@edit')->middleware('auth')->name('cedit');
Route::put('club/{id}/edit','ClubsController@update')->middleware('auth')->name('cupdate');
Route::post('club/{id}/edit','ClubUsersController@store')->middleware('auth')->name('addusr');
Route::delete('club/{id}/edit/{id2}','ClubUsersController@destroy')->middleware('auth')->name('removeUsr');

//post
Route::get('club/{id}/post','ClubPostsController@index')->middleware('auth');
Route::post('club/{id}/post','ClubPostsController@store')->middleware('auth')->name('cpost');
Route::get('club/{id}/post/{id2}','ClubPostsController@edit')->middleware('auth')->name('epost');
Route::put('club/{id}/post/{id2}','ClubPostsController@update')->middleware('auth')->name('epost2');
Route::delete('club/{id}/post/{id2}','ClubPostsController@destroy')->middleware('auth')->name('dpost');

//profile
Route::get('profile/{id}','UsersController@index')->middleware('auth')->name('profind');
Route::get('profile/{id}/edit','UsersController@edit')->middleware('auth')->name('uedit');
Route::put('profile/{id}/edit','UsersController@update')->middleware('auth')->name('uupdate');
Route::get('profile/{id}/password','UsersController@pass')->middleware('auth')->name('pass');
Route::put('profile/{id}/password','UsersController@changePass')->middleware('auth')->name('epass');

//follow
Route::get('club/{id}/follow','FollowsController@store')->middleware('auth')->name('fllw');
Route::get('club/{id}/unfollow','FollowsController@destroy')->middleware('auth')->name('ufllw');
Route::get('club/{id}/isfollowing','FollowsController@isfollowing')->middleware('auth')->name('isflw');
Route::get('club/{id}/followCount','FollowsController@followCount')->middleware('auth')->name('followCount');

//match
Route::get('cmatch','MatchsController@index')->middleware('auth')->name('cmatch');
Route::get('call','MatchsController@readall')->middleware('auth')->name('call');
Route::post('cmatch','MatchsController@store')->middleware('auth')->name('rmatch');
Route::get('schedule','MatchsController@schedule')->middleware('auth')->name('schedule');

//search
Route::post('search','HomeController@searchid')->middleware('auth')->name('searchid');
