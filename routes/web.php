<?php

Route::get('/', function () {
    return redirect('login');
});

Route::auth();

Route::get('/user/activation/{token}', 'Auth\AuthController@activate')->name('user.activate');
Route::get('/logout', 'Auth\LoginController@logout');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth.internal', 'portal.validate']], function () {

    Route::get('/dashboard', 'DashboardController@index');

    Route::group(['namespace' => 'Order', 'prefix' => 'order'], function () {

        Route::get('/',                                     'OrderController@index');
        Route::get('/{order}/show',                         'OrderController@show');

        // attendance list
        Route::get('/{order}/attendance-list',              'AttendanceListController@show');
        Route::get('/{order}/attendance-list/pdf',          'AttendanceListController@pdf');
        Route::post('/{order}/attendance-list/send',        'AttendanceListController@send');
        Route::post('/{order}/reminder/send',               'AttendanceListController@send');

        // timetracking
        Route::get('/{order}/timetracking',                 'TimeTrackingController@show');
        Route::post('/{order}/timetracking',                'TimeTrackingController@store');

    });

    Route::get('/timetracking', 'Order\TimeTrackingController@index');

    Route::group(['namespace' => 'Client', 'prefix' => 'client'], function () {

        Route::get('/', 'ClientController@index');
        Route::get('/{client}/show',                        'ClientController@show');
        Route::get('/{client}/profile',                     'ClientController@profile');
        Route::get('/{client}/history',                     'ClientController@history');
        Route::get('/{client}/invoice',                     'ClientController@invoice');
        Route::get('/{client}/documents',                   'ClientController@documents');

        // account
        Route::get('/{client}/account',                     'ClientController@account');
        Route::post('/{client}/account',                    'ClientController@createAccount');
        Route::post('/{client}/account/activate',           'AccountController@activate');
        Route::post('/{client}/account/deactivate',         'AccountController@deactivate');
        Route::post('/{client}/account/resend',             'ClientController@resendCredentials');

        // documents
        Route::get('/{client}/document/{document}',         'DocumentController@show');

        Route::post('/{client}/invoice/update',             'ClientController@updateInvoiceData');

    });

    Route::group(['namespace' => 'Employee'], function () {

        Route::group(['prefix' => 'employee'], function () {

            Route::get('/',                                 'EmployeeController@index');
            Route::get('/{employee}/show',                  'EmployeeController@show');
            Route::get('/{employee}/history',               'EmployeeController@history');
            Route::get('/{employee}/profile',               'EmployeeController@profile');
            Route::get('/{employee}/financials',            'EmployeeController@financials');
            Route::get('/{employee}/documents',             'EmployeeController@documents');

            // account
            Route::get('/{employee}/account',               'EmployeeController@account');
            Route::post('/{employee}/account',              'EmployeeController@createAccount');
            Route::post('/{employee}/account/resend',       'EmployeeController@resendCredentials');

            // documents
            Route::get('{employee}/document/base_data',     'DocumentController@baseData');
            Route::get('{employee}/document/{document}',    'DocumentController@show');

            Route::get('/payroll',                          'PayrollController@byMonth');
            Route::get('/{employee}/payroll/pdf',           'PayrollController@byEmployee');

        });

        Route::group(['prefix' => 'operation-plan'], function () {

            Route::post('/send',                            'OperationPlanController@send');
            Route::get('/send/order/{order}',               'OperationPlanController@sendByOrderLevel');

        });

    });

    Route::group(['prefix' => 'invoice'/*, 'middleware' => ['financial-access']*/], function () {

        Route::get('',                                      'InvoiceController@index');
        Route::get('/new',                                  'InvoiceController@create');
        Route::get('/{invoice}/edit',                       'InvoiceController@edit');
        Route::get('/{invoice}/new-item',                   'InvoiceController@newItem');
        Route::post('/{invoice}/update',                    'InvoiceController@update');
//        Route::post('/{invoice}/delete',          'InvoiceController@delete');

        // send
        Route::get('/{invoice}/prepare',                    'InvoiceController@prepare');
        Route::get('/{invoice}/warning',                    'InvoiceController@warning');

        Route::post('/{invoice}/warning',                   'InvoiceController@sendWarning');
        Route::post('/{invoice}/send',                      'InvoiceController@send');

        // pdf
        Route::get('/{invoice}/show',                       'InvoiceController@show');
        Route::get('/{invoice}/proof-of-work',              'InvoiceController@proofOfWork');
    });


    Route::group(['prefix' => 'calendar'], function () {
        Route::get('',                              'CalendarController@overview');
        Route::get('/employees',                    'CalendarController@employees');
        Route::get('/orders/by/{type}',             'CalendarController@ordersBy');
    });

    Route::group(['namespace' => 'Settings', 'prefix' => 'settings'], function () {

        Route::group(['prefix' => 'textblocks'], function () {

            Route::get('/general',                  'TextblocksController@edit');
            Route::post('/general',                 'TextblocksController@update');

            Route::get('/element/{type}',           'TextblocksController@edit');

            // document
            Route::get('document/{name}/preview',   'DocumentController@preview');
            Route::get('document/{name}',           'DocumentController@edit');
            Route::post('document/{name}',          'DocumentController@update');

            Route::get('/attendance-list/pdf',      'TextblocksController@sampleAttendanceList');

        });

        Route::group(['prefix' => 'user'], function () {
            Route::get('/',                         'UserController@index');
            Route::get('/create',                   'UserController@create');
            Route::post('/store',                   'UserController@store');
            Route::get('/{user}/show',              'UserController@show');
            Route::post('/{user}/update',           'UserController@update');
        });

        Route::group(['prefix' => 'account'], function () {
            Route::get('/credentials',              'AccountController@editCredentials');
            Route::post('/credentials',             'AccountController@updateCredentials');

            Route::get('/address',                  'AccountController@editAddress');
            Route::post('/address',                 'AccountController@updateAddress');

            Route::get('/signature',                'AccountController@editSignature');
            Route::post('/signature',               'AccountController@updateSignature');
        });

        Route::group(['prefix' => 'misc'], function () {
            Route::get('/salaries/pay',                     'SalaryController@pay');
            Route::get('/salaries/{term}',                  'SalaryController@general');

            Route::get('/collective-agreement/{term}',                  'ContractController@general');
        });
    });


    Route::group(['prefix' => 'reports'], function () {
        Route::get('',                              'ReportController@reports');
        Route::get('/orders',                       'ReportController@orders');
        Route::get('/employees',                    'ReportController@employees');
    });

    Route::get('/js/lang.js', function () {
        Cache::flush();
        $strings = Cache::rememberForever('lang.js', function () {
            $lang = config('app.locale');

            $files   = glob(resource_path('lang/' . $lang . '/*.php'));
            $strings = [];

            foreach ($files as $file) {
                $name           = basename($file, '.php');
                $strings[$name] = require $file;
            }

            return $strings;
        });

        header('Content-Type: text/javascript');
        echo('window.i18n = ' . json_encode($strings) . ';');
        exit();
    })->name('assets.lang.admin');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth.internal']], function () {
    Route::post('password-setup', 'SettingController@setuppassword')->name('setup-password');
});

Route::group(['namespace' => 'Client', 'prefix' => 'c', 'middleware' => ['auth.client', 'portal.validate']], function () {

        Route::get('dashboard',                     'ClientController@dashboard');
        Route::get('calendar',                      'ClientController@calendar');
        Route::get('profile',                       'ClientController@profile');
        Route::get('history',                       'ClientController@history');
        Route::get('invoices',                      'ClientController@invoices');

        // settings
        Route::get('settings',                      'ClientController@settings');
        Route::post('settings',                     'ClientController@updateSettings');

});

Route::group(['namespace' => 'Employee', 'prefix' => 'e', 'middleware' => ['auth.employee', 'portal.validate']], function () {

        Route::get('dashboard',                     'EmployeeController@dashboard');
        Route::get('calendar',                      'EmployeeController@calendar');
        Route::get('profile',                       'EmployeeController@profile');
        Route::get('documents',                     'EmployeeController@documents');
        Route::get('document/base_data',            'EmployeeController@baseData');
        Route::get('document/{document}',           'EmployeeController@document');
        Route::get('history',                       'EmployeeController@history');
        Route::get('payroll',                       'PayrollController@show');

        Route::get('settings',                      'EmployeeController@settings');
        Route::post('settings/account/credentials', 'EmployeeController@updateSettings');

        // message
        Route::post('message',                      'EmployeeController@sendMessage');

        Route::get('/js/lang.js', function () {
        Cache::flush();
        $strings = Cache::rememberForever('lang.js', function () {
            $lang = config('app.locale');

            $files   = glob(resource_path('lang/' . $lang . '/*.php'));
            $strings = [];

            foreach ($files as $file) {
                $name           = basename($file, '.php');
                $strings[$name] = require $file;
            }

            return $strings;
        });

        header('Content-Type: text/javascript');
        echo('window.i18n = ' . json_encode($strings) . ';');
        exit();
    })->name('assets.lang.e');
});