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


Route::get('/add-questions', 'QuestionsController@showAddForm');

Route::get('/exams', 'ExamsController@showAll')->name('exams');
Route::get('/exam/{exam}', 'ExamsController@showAddExamQuestion')->name('exams.show');
Route::post('/exams', 'ExamsController@add')->name('add-exam');

Route::post('/exam-add-question', 'ExamsController@addQuestion')->name('add-question');


Route::get('/', function () {
    return view('layouts.app');
});
Route::get('/{view?}', function () {
    return view('layouts.app');
})->where('view', '(.*)');
Auth::routes();

