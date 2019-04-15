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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::post('/signup',[
    'uses'=>'userCont@postSignUp',
    'as'=>'signup'
    ]);

Route::post('/signin',[
    'uses'=>'userCont@postSignIn',
    'as'=>'signin'
    ]);

Route::get('/logout',[
    'uses'=>'userCont@getLogout',
    'as'=>'logout',
    'middleware'=>'auth'
    ]);

Route::get('/account',[
    'uses'=>'userCont@getAccount',
    'as'=>'account',
    ]);

Route::get('/userimage/{fileName}',[
    'uses'=>'userCont@getImage',
    'as'=>'account.image',
    ]);

Route::post('/updateaccount',[
    'uses'=>'userCont@saveAccount',
    'as'=>'account.save',
    ]);

Route::get('/dashboard',[
    'uses'=>'userCont@getDashboard',
    'as'=>'dashboard',
    'middleware'=>'auth'
    ]);

Route::post('/createpost',[
    'uses'=>'postCont@createPost',
    'as'=>'post.create',
    'middleware'=>'auth'
    ]);

Route::get('/deletepost/{id}',[
    'uses'=>'postCont@deletePost',
    'as'=>'post.delete',
    'middleware'=>'auth'
    ]);

Route::post('/edit', [
    'uses' => 'postCont@editPost',
    'as' => 'edit'
]);

Route::post('/like', [
    'uses' => 'postCont@likePost',
    'as' => 'like'
]);