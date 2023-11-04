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

Route::middleware('auth')->namespace('App\Http\Controllers')->group(function () {
    Route::get('/', function () {
        if(auth()->user()->role == 'teacher')
            return redirect()->route('students');
        else return redirect()->route('scores.student', ['id' => auth()->user()->profile->id]);
    })->name('index');

    Route::get('/students', 'StudentController@index')->name('students');
    Route::get('/students/create', 'StudentController@add')->name('students.add');
    Route::post('/students/create', 'StudentController@create')->name('students.create');
    Route::get('/students/update/{id}', 'StudentController@edit')->name('students.edit');
    Route::post('/students/update/{id}', 'StudentController@update')->name('students.update');
    Route::get('/students/delete/{id}', 'StudentController@delete')->name('students.delete');

    Route::get('/teachers', 'TeacherController@index')->name('teachers');
    Route::get('/teachers/create', 'TeacherController@add')->name('teachers.add');
    Route::post('/teachers/create', 'TeacherController@create')->name('teachers.create');
    Route::get('/teachers/update/{id}', 'TeacherController@edit')->name('teachers.edit');
    Route::post('/teachers/update/{id}', 'TeacherController@update')->name('teachers.update');
    Route::get('/teachers/delete/{id}', 'TeacherController@delete')->name('teachers.delete');


    Route::get('/logout', 'LoginController@logout')->name('logout');
});

Route::middleware('guest')->namespace('App\Http\Controllers')->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/login', 'LoginController@authenticate')->name('login.post');
});
