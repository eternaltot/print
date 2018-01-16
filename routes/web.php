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
});

Route::get('/picture/all/',function(){
	return view('picture',array('tag'=>'กะทิชาวเกาะ'));
});

Route::get('/picture/all/{tag}',function($tag){
	return view('picture',array('tag'=>$tag));
})->name('picture');

Route::get('/picture/ig/',function(){
	return view('ig',array('tag'=>'กะทิชาวเกาะ'));
});

Route::get('/picture/ig/{tag}',function($tag){
	return view('ig',array('tag'=>$tag));
});

Route::get('/picture/folder/',function(){
	return view('folder',array('tag'=>'กะทิชาวเกาะ'));
});

Route::get('/resize',"PictureController@resizeAll");

Route::get('/print',"PrintController@index");

Route::get('/print/image',"PrintController@printImage")->name("printimage");

Route::post('/print',"PrintController@showImage");

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');

