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
// Route::get('/users/{id}', function ($id) {
//     return $id;
// });

// Route::get('/', function () {
//     return view('welcome');
// });


//calling the index function inside the controller
Route::get('/', 'PagesController@index');
Route::get('/consume','MainController@index');
//calling the employees function to render
//Route::get('/employees','PagesController@employees');

//calling the employees function to render
//Route::get('/departments','PagesController@departments');

//create all the routing for all controllers
Route::resource('employees','EmployeesController');
Route::resource('departments','DepartmentsController');
Route::resource('departmentsEmployees','DepartmentsEmployeesController');

//generated routes for login and registerations
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('sendbasicemail','MainController@basic_email');



