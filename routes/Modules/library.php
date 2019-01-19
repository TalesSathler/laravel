<?php

Route::group(['prefix' => 'library', 'middleware' => 'auth'], function (){

    /**
     * Book Routes
     */
    Route::group(['prefix' => 'book'], function (){
        Route::get('/index', 'Modules\Library\BookController@index')->name('library-book-index');
        Route::get('/create', 'Modules\Library\BookController@create')->name('library-book-create');
        Route::post('/create', 'Modules\Library\BookController@create')->name('library-book-create');
        Route::get('/edit', 'Modules\Library\BookController@edit')->name('library-book-edit');
        Route::post('/edit', 'Modules\Library\BookController@edit')->name('library-book-edit');
        Route::get('/delete', 'Modules\Library\BookController@delete')->name('library-book-delete');
        Route::post('/delete', 'Modules\Library\BookController@delete')->name('library-book-delete');
    });


    /**
     * Author Routes
     */
    Route::group(['prefix' => 'author'], function (){
        Route::get('/index', 'Modules\Library\AuthorController@index')->name('library-author-index');
        Route::get('/create', 'Modules\Library\AuthorController@create')->name('library-author-create');
        Route::post('/create', 'Modules\Library\AuthorController@create')->name('library-author-create');
        Route::get('/edit', 'Modules\Library\AuthorController@edit')->name('library-author-edit');
        Route::post('/edit', 'Modules\Library\AuthorController@edit')->name('library-author-edit');
        Route::get('/delete', 'Modules\Library\AuthorController@delete')->name('library-author-delete');
        Route::post('/delete', 'Modules\Library\AuthorController@delete')->name('library-author-delete');
    });


    /**
     * Daily Routes
     */
    Route::group(['prefix' => 'daily'], function (){
        Route::get('/index', 'Modules\Library\DailyController@index')->name('library-daily-index');
        Route::get('/create', 'Modules\Library\DailyController@create')->name('library-daily-create');
        Route::post('/create', 'Modules\Library\DailyController@create')->name('library-daily-create');
        Route::get('/edit', 'Modules\Library\DailyController@edit')->name('library-daily-edit');
        Route::post('/edit', 'Modules\Library\DailyController@edit')->name('library-daily-edit');
        Route::get('/delete', 'Modules\Library\DailyController@delete')->name('library-daily-delete');
        Route::post('/delete', 'Modules\Library\DailyController@delete')->name('library-daily-delete');
    });
});