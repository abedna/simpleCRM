<?php


Route::group([

    'middleware' => 'web',
    'namespace' => 'App\Modules\Companies\Controllers'],
    function(){

        Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

        Auth::routes();

        Route::get('/home', 'HomeController@index')->name('home');

        Route::post('post-company', 'HomeController@store');

        Route::get('delete-company/{id}', [
        'as' => 'id', 'uses' => 'HomeController@destroy'
        ]);
        Route::get('edit-company/{company}', 'HomeController@edit');

        Route::post('edit-company/update-company/{company}', 'HomeController@update')->name('update');

        Route::get('company/{company}/employees', 'EmployeesController@show')->name('listemployees');

        Route::post('company/{company}/employees', 'EmployeesController@store');

        Route::get('company/{company}/employees/{employee}/delete', 'EmployeesController@delete');

        Route::get('company/{company}/employees/{employee}/edit', 'EmployeesController@edit');

        Route::post('/company/{company}/employees/{employee}/update', 'EmployeesController@update');


});