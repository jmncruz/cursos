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

Route::get('/', function () {
    return view('layout');
});

//PAGE ADMIN/STUDENTS
Route::group([

    //'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'admin'

], function () {

    Route::get('students/show', 'StudentsController@show');
    Route::post('students/storage', 'StudentsController@storage');

});

//PAGE ADMIN/COURSES
Route::group([

    //'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'admin/'

], function () {

    Route::get('courses/storage', 'CoursesController@storage');
    Route::get('courses/update', 'CoursesController@update');
    Route::get('courses/delete', 'CoursesController@delete');
    Route::get('courses/show', 'CoursesController@show');
    Route::post('courses/upload', 'CoursesController@upload');
    
});


//PAGE ADMIN/ADDRESSES
Route::group([

    //'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'admin/'

], function () {

    Route::get('addresses/storage', 'AddressesController@storage');
    
});