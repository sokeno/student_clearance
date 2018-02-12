<?php

Route::get('/', 'PagesController@index')->name('index');

Route::get('/profile', 'PagesController@profile')->name('profile');

Route::get('/about', 'PagesController@about')->name('about');

Route::resource('college', 'CollegeController');

Route::resource('department', 'DepartmentController');

Route::resource('college.department', 'CollegeDepartmentController');

Route::resource('program', 'ProgramController');

Route::resource('student', 'StudentController');

Route::resource('staff', 'StaffController');

Route::get('admin', 'AdminController@index');


Route::resource('deficiency', 'DeficiencyController');

Route::patch('deficiency/{deficiency}/complete', 'DeficiencyController@complete');

Route::resource('student.deficiency', 'StudentDeficiencyController');

Route::get('student/{student}/pdf', 'StudentController@pdf');

Route::get('student/{student}/html', 'StudentController@html');

Route::get('autocomplete', 'PagesController@autocomplete')->name('autocomplete');

//Auth::routes();

Route::get('login', 'Auth\LoginController@login');
Route::post('login', 'Auth\LoginController@postLogin');

Route::get('register', 'Auth\RegisterController@getregister');
Route::get('staff_register', 'Auth\RegisterController@staff_register');
Route::post('register', 'Auth\RegisterController@postregister');

Route::post('logout', 'Auth\LoginController@logout');


Route::get('home', function(){
	return redirect('/profile');
})->name('home');

Route::get('logs', 'PagesController@logs');

Route::get('log', 'PagesController@log');

Route::get('google', 'PagesController@google');

Route::get('glogin', 'PagesController@googleLogin')->name('glogin');

Route::get('search', 'PagesController@search')->name('search');

Route::post('requestclearance', 'ClearanceController@requestClearance');

Route::get('clearanceform', 'ClearanceController@form')->middleware('studentprofile');

Route::post('clearanceform/pdf', 'ClearanceController@pdf')->middleware('studentprofile');

Route::resource('department.tasks', 'TaskListController');

Route::resource('department.tasks.items', 'TaskListItemController');
