<?php

Route::group([

    'middleware' => 'web',
    'namespace' => 'App\Modules\Companies\Controllers'],
    function(){

        Route::get('switchLanguage/{lang}', 'LanguageController@switchLanguage');

        //Musi być przed Auth::routes();!!
        //1.
        Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
        //2.
        Auth::routes();

        Route::get('home', 'HomeController@index')->name('home');

        Route::post('companies/post', 'HomeController@store');

        Route::get('companies/{company}', 'HomeController@view');

        Route::delete('companies/{company}', 'HomeController@destroy')->name('companies.delete');

        Route::get('companies/{company}/edit', [
            'uses' => 'HomeController@edit',
           // 'middleware' => ['role:admin'],
        ]);

        Route::post('companies/{company}/update', 'HomeController@update')->name('update');

        Route::get('companies/{company}/employees', 'EmployeesController@show')->name('listemployees');

        Route::post('companies/{company}/employees', 'EmployeesController@store');

        Route::delete('companies/{company}/employees/{employee}', 'EmployeesController@delete')->name('employees.delete');

        Route::get('companies/{company}/employees/{employee}/edit', 'EmployeesController@edit');

        Route::post('companies/{company}/employees/{employee}/update', 'EmployeesController@update');

        Route::get('downloadInfo', 'ExportController@exportInfo');

});
