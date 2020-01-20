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

Auth::routes();

Route::get('/home', 'HomeController@index');
 
Route::post('/home','HomeController@store');

Route::post('/admin','HomeController@delete');

Route::get('/admin','HomeController@index');

//crud employees
Route::post('/admin/edit','HomeController@edit');

Route::post('/admin/edit/store','HomeController@update');
Route::get('/admin/edit','HomeController@index');//duhet pa se njoftimet du ti nxjerre po te e njejta faqqe kur ka 
//field bosh(biraz onemli)

 
//crud departaments
Route::get('/depart','Departament@index');
Route::post('/rdepart','Departament@fshidepart');
Route::post('/editodep','Departament@edit');
Route::post('/storedep','Departament@update');
Route::get('/editodep','Departament@index');
Route::get('/createdep','Departament@create');
Route::post('/adddep','Departament@add'); 
Route::get('/gjejfmi/{id}','Departament@gjejfmi');


//tree view
Route::get('/treeview','Departament@displaytree');
Route::get('/treeview1','Departament@displaytree1');
Route::get('/nendepartament/{id}','Departament@nendep');
Route::post('/addchild','Departament@ruajnendep');

//chat 
Route::get('/chat','HomeController@chat');
Route::get('/message/{id}', 'HomeController@getMessage')->name('message');
Route::post('message', 'HomeController@sendMessage');