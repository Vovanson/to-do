<?php

Route::get('/', function () {
    return view('content');
});

/**
 * Get Categories & Tasks
 */
Route::get('/category', 'CategoryController@getAll');


/**
 * Add New Category
 */
Route::post('/category', 'CategoryController@addCategory');


/**
 * Add New Task
 */
Route::post('/task', 'TaskController@addTask');


/**
 * Delete Task
 */
Route::delete('/task/{task}', 'TaskController@deleteTask');


/**
 * Update Task
 */
Route::patch('/task/{task}', 'TaskController@updateTask');

