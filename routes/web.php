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


Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/logout', function () {
    Session::flush();
    return redirect()->route('login');
})->name('logout');

Route::group([
    'middleware' => 'auth',
], function () {

    Route::any('/', function () {
        return view('profile/welcome');
    });

});

Route::group([
    //'middleware' => 'auth',
], function () {

    Route::get('/profile', function () {
        return view('profile/profile');
    });
    

});

//PAGE ADMIN/STUDENTS
Route::group([

    //'middleware' => 'auth',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'admin'

], function () {

    Route::get('students/show', 'StudentsController@show');
    Route::get('students/show/{id}', 'StudentsController@showId');
    Route::post('students/storage', 'StudentsController@storage');
    Route::get('students/delete', 'StudentsController@delete');
    Route::get('students/update', 'StudentsController@update');

});

//PAGE ADMIN/COURSES
Route::group([

    //'middleware' => 'auth',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'admin/'

], function () {

    Route::get('courses/storage', 'CoursesController@storage');
    Route::get('courses/update', 'CoursesController@update');
    Route::get('courses/delete', 'CoursesController@delete');
    Route::get('courses/show', 'CoursesController@show');
    Route::post('courses/upload', 'CoursesController@upload');
    
});

//PAGE ADMIN/SETUP
Route::group([

    //'middleware' => 'auth',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'admin/'

], function () {

    Route::get('setup', 'SetupsController@setup');
    
});


//PAGE ADMIN/ADDRESSES
Route::group([

    //'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'admin/'

], function () {

    Route::get('addresses/storage', 'AddressesController@storage');
    
});
