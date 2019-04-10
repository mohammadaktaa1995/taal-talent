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

// Questions
Route::delete('delete-question/{question}', 'QuestionsController@deleteQuestion')->name('delete-question');
Route::patch('edit-question/{question}', 'QuestionsController@updateQuestion')->name('edit-question');
Route::post('add-question', 'QuestionsController@addQuestion')->name('add-question');
//

//Exams
Route::get('/', 'ExamsController@showAll');
Route::get('/exams', 'ExamsController@showAll')->name('exams');
Route::get('/exams/{exam}', 'ExamsController@showAddExamQuestion')->name('exams.show');
Route::post('/exams', 'ExamsController@add')->name('add-exam');
Route::patch('/exams/{exam}', 'ExamsController@update')->name('edit-exam');
Route::delete('/exams/{exam}', 'ExamsController@delete')->name('delete-exam');
//

Route::group(['prefix' => 'test'], function () {
    Route::get('/', 'TestController@showExams')->name('test.exams');
    Route::get('/exam-questions/{exam}', 'TestController@showExamQuestions')->name('test.exam-questions');
});

Auth::routes();

