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


Auth::routes();

Route::get('/', 'SiteController@index')->name('home');//гдавная страница
Route::group([
    'middleware' => 'auth'
], function () {

    Route::post('/addReview', 'ReviewController@add')->name('add_review');//добавление отзыва
    Route::get('/my_review', 'ReviewController@show')->name('my_review');//посмотреть только свои отзывы
    Route::post('/delete', 'ReviewController@delete')->name('delete');//удаление отзыва
    Route::get('/edit/{id}', 'ReviewController@edit')->name('edit');//редактирование отзыва
    Route::post('/update/{review}', 'ReviewController@update')->name('update');//сохранение редактируемого отзыва
    Route::get('/all_reviews', 'ExcelController@allReviews')->middleware('admin')->name('all_review');//все отзывы в .xlsx
});
