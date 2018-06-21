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

// Route::get('/', function () {
//     return view('picture');
// });

Route::get('/',"PictureController@index");
Route::get('/picture/all',"PictureController@index");

// Route::get('/picture/all',function(){
// 	return view('picture');
// });
//
// Route::get('/picture/all/{tag}',function($tag){
// 	return view('picture',array('tag'=>$tag));
// })->name('picture');

Route::get('/picture/ig/',function(){
	return view('ig');
});

// Route::get('/picture/ig/{tag}',function($tag){
// 	return view('ig',array('tag'=>$tag));
// });

Route::get('/picture/folder/',function(){
	return view('folder');
});

Route::get('/choose/',function(){
	return view('choose');
})->name('chooseframe');

// Route::get('/resize',"PictureController@resizeAll");

Route::get('/print',"PrintController@index");

Route::get('/print/image',"PrintController@printImage")->name("printimage");

Route::post('/print',"PrintController@showImage")->name("print");
Route::post('/confirm',"ConfirmController@showImage")->name("confirm");


Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');

Route::get('upload', function () {
    return view('upload');
});

Route::post('upload', 'UploadController@upload');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin', 'Admin\AdminController@index');
Route::resource('admin/roles', 'Admin\RolesController');
Route::resource('admin/permissions', 'Admin\PermissionsController');
Route::resource('admin/users', 'Admin\UsersController');
Route::resource('admin/tags', 'Admin\TagsController');
Route::resource('admin/frames', 'Admin\FramesController');
Route::get('admin/tags/backup/{id}',['uses' =>'Admin\TagsController@backup'])->name('backup');
Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);
