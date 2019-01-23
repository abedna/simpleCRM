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

        Route::get('companies', 'CompaniesController@index')->name('companies.index');

        Route::post('companies/post', 'CompaniesController@store');

        Route::get('companies/{company}', 'CompaniesController@view');

        Route::delete('companies/{company}', 'CompaniesController@destroy')->name('companies.delete');

        Route::get('companies/{company}/edit', [
            'uses' => 'CompaniesController@edit',
           // 'middleware' => ['role:admin'],
        ]);

        Route::patch('companies/{company}', 'CompaniesController@update')->name('companies.update');

        Route::get('companies/{company}/employees', 'EmployeesController@show')->name('listemployees');

        Route::post('companies/{company}/employees', 'EmployeesController@store');

        Route::delete('companies/{company}/employees/{employee}', 'EmployeesController@delete')->name('employees.delete');

        Route::get('companies/{company}/employees/{employee}/edit', 'EmployeesController@edit');

        Route::patch('companies/{company}/employees/{employee}', 'EmployeesController@update')->name('employees.update');

        Route::get('downloadInfo', 'ExportController@exportInfo');

});
