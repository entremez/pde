<?php

    Route::get('/', 'HomeController@welcome' )->name('welcome');
    Route::get('/travel', 'Company\TravelController@travel' );
    Route::post('/travel', 'Company\TravelController@responses')->name('response.travel');

    //Route::get('/proveedores', 'Auth\RegisterController@providerRegister' )->name('provider.register');
    Route::get('/proveedores', 'HomeController@welcome' )->name('provider.register');
    Route::get('/empresas', 'Auth\RegisterController@providerRegister' )->name('provider.register');
    Route::post('/empresas', 'Auth\RegisterController@companyRegister' )->name('register-company');
    Route::get('/new-company/{token}', 'Auth\RegisterController@newCompany' )->name('new-company');
    Route::post('/new-company/', 'Auth\RegisterController@newCompanyNewPass' )->name('new-company-new-pass');


    Route::get('/cases', 'InstanceController@index')->name('cases');
    Route::get('/cases/{key}/{id}', 'InstanceController@indexWithParameters')->name('casesWithParameters');
    Route::post('/cases', 'InstanceController@index');

    Route::get('/resources', 'HomeController@resources')->name('resources');
    Route::get('/ecosystem-and-team', 'HomeController@team')->name('team');

    Route::get('/evaluate', 'HomeController@evaluate')->name('evaluate');


    Route::get('/provider', 'ProviderController@show')->name('providers-list');
    Route::post('/provider/service/{serviceId}', 'ProviderController@filtered')->name('providers-list-filtered');
    Route::get('/provider/service/{serviceId}', 'ProviderController@filtered')->name('providers-list-filtered');

    Route::get('/provider/{provider}', 'ProviderController@detail')->middleware('verified.approval')->name('provider');

    Route::post('/provider/c/{providerId}', 'ProviderController@counterClick')->name('provider-counter');

    Route::get('/case/{instance}', 'InstanceController@show')->middleware('verified.approval')->name('case');

    Route::get('/case/{instance}/buffer', 'InstanceController@showBuffered')->middleware('verified.approval')->name('case.buffered');

    Route::post('/case/{provider}', 'CounterController@provider')->name('provider.counter');

    Route::get('/tag/{service}', 'ServiceController@show')->name('service');

    Auth::routes();

    Route::get('/home', 'HomeController@index')->middleware('auth')->name('home');

    //RUTAS ADMINISTRADORES

    Route::get('/dashboard/services', 'ServiceController@show')->name('service.crud')->middleware('admin');
    Route::post('/dashboard/services', 'ServiceController@save')->name('service.crud.save')->middleware('admin');

    Route::group([
                'prefix' => 'admin',
                'middleware' => ['admin'],
                'namespace'  => 'Admin'],
                function()
    {
        Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
        Route::get('/download/{instance}/{type}', 'AdminController@download')->name('admin.download');
        Route::get('/dashboard/mails', 'AdminController@mails')->name('mails.body');
        Route::post('/dashboard/mails', 'AdminController@mailsStore')->name('mails.store');
        Route::get('/dashboard/statistics', 'AdminController@statistics')->name('statistics');
        Route::get('/dashboard/providers', 'AdminController@showProviders')->name('providers');
        Route::get('/dashboard/providers/request', 'AdminController@request')->name('admin.request');
        Route::get('/dashboard/companies', 'AdminController@showCompanies')->name('companies');
        //Route::get('/dashboard/providers/{provider}/edit', 'Provider\AdminProviderController@edit')->name('edit-provider');
        Route::get('/register', 'RegisterController@showRegistrationForm')->name('admin-register');
        Route::post('/register', 'RegisterController@create');

        Route::resource('surveys', 'Survey\SurveyController');

        Route::resource('questions', 'Survey\QuestionController');
        Route::resource('question_types', 'Survey\QuestionTypeController');
        Route::resource('response_choices', 'Survey\ResponseChoiceController');


        Route::post('/dashboard/provider-approve', 'Provider\ProviderController@approveProvider')->name('approve.provider');
        Route::post('/dashboard/provider-delete', 'Provider\ProviderController@deleteProvider')->name('delete.provider');
        Route::post('/dashboard/instance-approve', 'Provider\ProviderController@approveInstance')->name('approve.instance');
        Route::post('/dashboard/instance-destroy', 'Provider\ProviderController@deleteInstance')->name('delete.instance');
        Route::post('/dashboard/instance-buffered-approve', 'Provider\ProviderController@approveInstanceBuffered')->name('approve.instance.buffered');
        Route::post('/dashboard/provider-buffered-approve', 'Provider\ProviderController@approveProviderBuffered')->name('approve.provider.buffered');
        Route::post('/dashboard/featured', 'AdminController@instanceFeatured')->name('featured');


        Route::post('/dashboard/provider-comments', 'Provider\ProviderController@sendCommentsToProvider')->name('comment.provider');
        Route::post('/dashboard/user-without-profile', 'AdminController@userWithoutProfile')->name('user.without.profile');
        Route::post('/dashboard/user-ignore', 'AdminController@userIgnore')->name('user.ignore');

        Route::get('/buffered/{provider}/provider', 'Provider\ProviderController@providerBuffered' )->name('provider.buffered');    
        Route::get('/dashboard/resources', 'AdminController@showResources' )->name('resources.show');    
        Route::post('/dashboard/resources', 'AdminController@updateResources' )->name('resources.show');
        Route::get('/dashboard/survey', 'AdminController@showSurvey' )->name('survey.show');  
        Route::post('/dashboard/survey', 'AdminController@updateSurvey' )->name('survey.show'); 
        Route::get('/dashboard/recommendation', 'AdminController@showRecommendation' )->name('recomm.show');   
    });



    //RUTAS PROVEEDORES

    Route::group([
            'prefix' => 'providers',
            'middleware' => ['provider'],
            'namespace'  => 'Provider'],
            function()
    {

        Route::get('/verify' , 'VerifyMailController@verify')->name('verify');
        Route::get('/verify/{id}/{token}' , 'VerifyMailController@verification')->name('verification');
        Route::get('/dashboard', 'ProviderController@index')->name('provider.dashboard');
        Route::get('/c/dashboard', 'ProviderController@index')->name('cities');
        Route::post('/dashboard','ProviderController@create')->name('provider.config');
        Route::put('/dashboard','ProviderController@request')->name('provider.request'); // ?
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
    Route::get('/password/new', 'Auth\NewPasswordController@new')->name('password.new')->middleware('provider');
    Route::post('/password/new', 'Auth\NewPasswordController@store')->name('password.store');


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
        Route::post('/timeline', 'CompanyController@popUp')->name('popup');
        Route::get('/travel','TravelController@travel')->name('travel');
        Route::post('/travel','TravelController@responses')->name('responses');
    });


        Route::get('/pdf/{id}', 'PdfController@getTravel')->name('pdf');

    /*Route::get('/login/travel', 'Auth\LoginController@showLoginFormTrip')->name('travel.login');
    Route::get('/guest/travel','TravelController@guestTravel')->name('travel.guest');*/



    //IMAxD
    Route::get('/imaxd', 'ImaxdControllers\HomeController@getHome')->name('imaxd-home');
    Route::get('/imaxd/faq', 'ImaxdControllers\HomeController@getHome')->name('imaxd-faq');

    Route::group([
        'prefix' => 'imaxd',
        'middleware' => ['imaxd'],
        'namespace'  => 'ImaxdControllers'],
        function()
    {
        Route::get('/dashboard','HomeController@getDashboard')->name('imaxd-dashboard');
        Route::post('/dashboard','HomeController@config')->name('imaxd-config');
        Route::get('/evaluate','HomeController@getEvaluation')->name('imaxd-evaluate');
        Route::post('/evaluate','HomeController@evaluation')->name('imaxd-evaluation');
        Route::post('/evaluate/design','HomeController@evaluationDesign')->name('imaxd-evaluation-design');
        Route::get('/result','HomeController@getResult')->name('imaxd-result');
    });