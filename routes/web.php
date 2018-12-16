<?php

Route::get('/', 'HomeController@welcome' )->name('welcome');

Route::post('/classifications-data-json', 'InstanceController@classifications');
Route::post('/images-data-json', 'InstanceController@images');

Route::get('/cases', 'InstanceController@index')->name('cases');
Route::post('/cases', 'InstanceController@index');
Route::get('/resources', 'HomeController@resources')->name('resources');

Route::get('/evaluate', 'HomeController@evaluate')->name('evaluate');

Route::get('/provider', 'ProviderController@show')->name('providers-list');
Route::post('/provider/{serviceId}', 'ProviderController@filtered')->name('providers-list-filtered');

Route::get('/provider/{provider}', 'ProviderController@detail')->name('provider');

Route::post('/provider/c/{providerId}', 'ProviderController@counterClick')->name('provider-counter');

Route::get('/case/{instance}', 'InstanceController@show')->name('case');

Route::post('/case/{provider}', 'CounterController@provider')->name('provider.counter');

Route::get('/tag/{service}', 'ServiceController@show')->name('service');

Auth::routes();

Route::get('/home', 'HomeController@index')->middleware('auth')->name('home');


//RUTAS ADMINISTRADORES
Route::group([
            'prefix' => 'admin',
            'middleware' => ['admin'],
            'namespace'  => 'Admin'],
            function()
{
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('/dashboard/providers', 'AdminController@showProviders')->name('providers');
    Route::get('/dashboard/providers/request', 'AdminController@request')->name('admin.request');
    Route::get('/dashboard/companies', 'AdminController@showCompanies')->name('companies');
    Route::get('/dashboard/providers/{provider}/edit', 'Provider\AdminProviderController@edit')->name('edit-provider');
    Route::get('/register', 'RegisterController@showRegistrationForm')->name('admin-register');
    Route::post('/register', 'RegisterController@create');

    Route::resource('surveys', 'Survey\SurveyController');

    Route::resource('questions', 'Survey\QuestionController');
    Route::resource('question_types', 'Survey\QuestionTypeController');
    Route::resource('response_choices', 'Survey\ResponseChoiceController');
});

//RUTAS PROVEEDORES

Route::group([
        'prefix' => 'providers',
        'middleware' => ['provider'],
        'namespace'  => 'Provider'],
        function()
{
    Route::get('/dashboard', 'ProviderController@index')->name('provider.dashboard');
    Route::post('/dashboard','ProviderController@edit')->name('provider.config');
    Route::put('/dashboard','ProviderController@request')->name('provider.request');
    Route::get('/settings','ProviderController@settings')->name('provider.settings');
    Route::post('/settings','ProviderController@update')->name('provider.update');
    Route::get('/cases/delete/', 'CaseController@destroy')->name('delete.case');
    Route::resource('cases', 'CaseController');
    Route::get('/case/{id}/images','CaseImagesController@index')->name('images.case');
    Route::delete('/case/{id}/images','CaseImagesController@destroy')->name('images.destroy');
    Route::post('/case/{id}/images','CaseImagesController@featured')->name('images.featured');
    Route::put('/case/{id}/images','CaseImagesController@update')->name('images.update');

});
//Route::get('/providers/register', 'Provider\RegisterController@showRegistrationForm')->name('provider-register');
Route::get('/providers/register', 'Provider\RegisterController@register')->name('provider-register-from-home');


// RUTAS EMPRESAS
Route::group([
        'prefix' => 'company',
        'middleware' => ['company'],
        'namespace'  => 'Company'],
        function()
{
    Route::get('/dashboard', 'CompanyController@index')->name('company.dashboard');
    Route::post('/dashboard', 'CompanyController@config')->name('company.config');
    Route::post('results', 'CompanyController@results')->name('company.result');


    Route::get('/timeline', 'CompanyController@timeline')->name('timeline');
    Route::get('/travel','TravelController@travel')->name('travel');
    Route::post('/travel','TravelController@responses')->name('responses');
});



/*Route::get('/login/travel', 'Auth\LoginController@showLoginFormTrip')->name('travel.login');
Route::get('/guest/travel','TravelController@guestTravel')->name('travel.guest');*/