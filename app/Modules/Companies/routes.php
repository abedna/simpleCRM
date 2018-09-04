<?php


Route::group([

    'middleware' => 'web',
    'namespace' => 'App\Modules\Companies\Controllers'],
    function(){

        Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

        Route::get('switchLanguage/{lang}', 'LanguageController@switchLanguage');

        Auth::routes();

        Route::get('home', 'HomeController@index')->name('home');

        Route::post('companies/post', 'HomeController@store');

        Route::get('companies/{company}', 'HomeController@view');

        Route::get('companies/{company}/delete', 'HomeController@destroy');

        Route::get('companies/{company}/edit', 'HomeController@edit');

        Route::post('companies/{company}/update', 'HomeController@update')->name('update');

        Route::get('companies/{company}/employees', 'EmployeesController@show')->name('listemployees');

        Route::post('companies/{company}/employees', 'EmployeesController@store');

        Route::get('companies/{company}/employees/{employee}/delete', 'EmployeesController@delete');

        Route::get('companies/{company}/employees/{employee}/edit', 'EmployeesController@edit');

        Route::post('companies/{company}/employees/{employee}/update', 'EmployeesController@update');

        Route::get('bestwage', 'EmployeesController@findHighestWages');

});