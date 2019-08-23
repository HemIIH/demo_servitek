<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'/*, 'middleware' => 'auth:api'*/], function () {

    Route::group(['namespace' => 'Client', 'prefix' => 'client'], function () {

        Route::get('/',                                         'ClientController@getData');
        Route::get('/get',                                      'ClientController@getAll');
        Route::get('/{client}',                                 'ClientController@get');
        Route::get('/{client}/latest-order',                    'ClientController@latestOrder');

        Route::post('/store',                                   'ClientController@store');
        Route::post('/{client}/update',                         'ClientController@update');
        Route::delete('/{client}',                              'ClientController@delete');

        // client logo
        Route::post('/{client}/logo/upload',                    'ClientController@uploadLogo');
        Route::post('/{client}/logo/delete',                    'ClientController@deleteLogo');

        // calendar
        Route::post('/{client}/calendar/dates',                 'CalendarController@getData');

        Route::post('/{client}/invoice-data',                   'ClientController@updateInvoiceData');

        // notes
        Route::get('/{client}/notes',                           'ClientController@getNotes');
        Route::post('/{client}/note',                           'ClientController@addNote');
        Route::patch('/{client}/note',                          'ClientController@updateNote');
        Route::delete('/{client}/note/{id}',                    'ClientController@deleteNote');

        // charge rates
        Route::get('/{client}/rate',                            'RateController@all');
        Route::get('/{client}/rate/{id}',                       'RateController@get');
        Route::post('/{client}/rate',                           'RateController@add');
        Route::post('/{client}/rate/{rate}/update',             'RateController@update');
        Route::delete('/{client}/rate/{rate}',                  'RateController@delete');

        // contacts
        Route::get('/{client}/contacts',                        'ContactController@getAll');
        Route::post('/{client}/contact',                        'ContactController@store');
        Route::post('/contact/{contact}/update',                'ContactController@update');
        Route::post('/{client}/contacts/responsibilities',      'ContactController@updateResponsibilities');
        Route::delete('/contact/{contact}',                     'ContactController@delete');

        // blacklist
        Route::get('{client}/blockedEmployees',                 'BlacklistController@getAll');
        Route::get('{client}/blacklist/add',                    'BlacklistController@addTo');
        Route::get('{client}/blacklist/remove',                 'BlacklistController@removeFrom');

        // documents
        Route::get('/{client}/documents',                       'DocumentsController@getAll');
        Route::post('/{client}/document/{document}/send',       'DocumentsController@send');
        Route::post('/{client}/document/{document}/update',     'DocumentsController@update');
        Route::post('/{client}/document/upload',                'DocumentsController@upload');
        Route::delete('/{client}/document/{id}',                'DocumentsController@delete');

    });

    Route::get('timetracking',                                  'TimeTrackingController@getData');

    // account
    Route::post('/account/{user}/activate',                     'AccountController@activate');
    Route::post('/account/{user}/deactivate',                   'AccountController@deactivate');
    Route::post('/account/{user}/credentials/resend',           'AccountController@resendCredentials');


    Route::get('/roles',                                        'RoleController@all');

    Route::group(['prefix' => 'order'], function () {

        Route::get('/',                                         'OrderController@getData');
        Route::get('/{order}',                                  'OrderController@get');

        // store and edit
        Route::post('/store',                                   'OrderController@store');
        Route::post('/{order}/update',                          'OrderController@update');
        Route::post('/{order}/activate',                        'OrderController@activate');
        Route::post('/{order}/approve',                         'OrderController@approve');
        Route::post('/{order}/cancel',                          'OrderController@cancel');
        Route::delete('/{order}',                               'OrderController@delete');

        // notes
        Route::get('/{order}/notes',                            'OrderController@getNotes');
        Route::post('/{order}/note',                            'OrderController@addNote');
        Route::patch('/{order}/note',                           'OrderController@updateNote');
        Route::delete('/{order}/note/{id}',                     'OrderController@deleteNote');

        // allocation
        Route::get('/{order}/employee/{employee}',              'OrderController@getEmployee');
        Route::get('/{order}/employee/{employee}/check',        'OrderController@check');
        Route::get('/{order}/employee/{employee}/assign',       'OrderController@attachEmployee');
        Route::get('/{order}/employee/{employee}/unassign',     'OrderController@detachEmployee');
        Route::get('/{order}/employees/assigned',               'OrderController@getAssignedEmployees');
        Route::get('/{order}/employees/available',              'OrderController@getAvailableEmployees');
        Route::post('/{order}/personal/save',                   'OrderController@save');

        // calculations
        Route::post('/{order}/accounting',                      'OrderController@accounting');
        Route::post('/{order}/calculation',                     'OrderController@calculation');

        // attendance list
        Route::post('/{order}/attendance-list/reminder',        'OrderController@reminder');

    });

    Route::group(['prefix' => 'orders'], function () {

        Route::post('/by/week',                                 'CalendarController@getOrdersByWeek');
        Route::get('/by/week',                                  'CalendarController@getOrdersByWeek');
        Route::post('/by/month',                                'CalendarController@getOrdersByMonth');

    });


    Route::group(['namespace' => 'Employee', 'prefix' => 'employee'], function () {

        Route::get('/',                                                 'EmployeeController@getData');
        Route::get('/all',                                              'EmployeeController@getAll');

        Route::get('/{employee}',                                       'EmployeeController@get');
        Route::post('/store',                                           'EmployeeController@store');
        Route::post('/{employee}/update',                               'EmployeeController@update');
        Route::delete('/{employee}',                                    'EmployeeController@delete');

        // employee photo
        Route::post('/{employee}/photo/upload',                         'EmployeeController@uploadPhoto');
        Route::post('/{employee}/photo/delete',                         'EmployeeController@deletePhoto');

        // calendar
        Route::post('/{employee}/calendar/dates',                       'CalendarController@getData');
        Route::get('/{employee}/calendar/timeoffs',                     'CalendarController@getTimeOffs');

        // roles
        Route::post('/{employee}/roles/update',                         'EmployeeController@updateRoles');

        // timeoff
        Route::get('/{employee}/timeoff',                               'TimeOffController@get');
        Route::post('/{employee}/timeoff',                              'TimeOffController@add');
        Route::post('/{employee}/timeoff/delete',                       'TimeOffController@delete');

        // notes
        Route::get('/{employee}/notes',                                 'EmployeeController@getNotes');
        Route::post('/{employee}/note',                                 'EmployeeController@addNote');
        Route::patch('/{employee}/note',                                'EmployeeController@updateNote');
        Route::delete('/{employee}/note/{id}',                          'EmployeeController@deleteNote');

        // wages
        Route::get('/{employee}/wage',                                  'WageController@all');
        Route::post('/{employee}/wage',                                 'WageController@add');
        Route::post('/{employee}/wage/{wage}/update',                   'WageController@update');
        Route::delete('/{employee}/wage/{wage}',                        'WageController@delete');

        // workingHours
        Route::get('/{employee}/workingHours',                          'WorkingHoursController@all');
        Route::post('/{employee}/workingHours',                         'WorkingHoursController@add');
        Route::post('/{employee}/workingHours/{hour}/update',           'WorkingHoursController@update');
        Route::delete('/{employee}/workingHours/{hour}',                'WorkingHoursController@delete');

        // extraBusiness
        Route::get('/{employee}/extraBusiness',                         'ExtraBusinessController@all');
        Route::post('/{employee}/extraBusiness',                        'ExtraBusinessController@add');
        Route::post('/{employee}/extraBusiness/{extraBusiness}/update', 'ExtraBusinessController@update');
        Route::delete('/{employee}/extraBusiness/{extraBusiness}',      'ExtraBusinessController@delete');

        // payroll
        Route::get('/{employee}/payroll',                               'PayrollController@all');
        Route::post('/{employee}/payroll',                              'PayrollController@add');
        Route::post('/{employee}/payroll/{payrollModification}/update', 'PayrollController@update');
        Route::delete('/{employee}/payroll/{payrollModification}',      'PayrollController@delete');

        // documents
        Route::get('/{employee}/documents',                             'DocumentsController@getAll');
        Route::post('/{employee}/document/{document}/send',             'DocumentsController@send');
        Route::post('/{employee}/document/{document}/update',           'DocumentsController@update');
        Route::post('/{employee}/document/upload',                      'DocumentsController@upload');
        Route::post('/{employee}/document/pension',                     'DocumentsController@createPension');
        Route::post('/{employee}/document/{type}',                      'DocumentsController@create');
        Route::delete('/{employee}/document/{id}',                      'DocumentsController@delete');

        // signature
        Route::post('/{employee}/signature',                            'SignatureController@create');
        Route::delete('/{employee}/signature',                          'SignatureController@delete');
    });

    Route::group(['prefix' => 'invoice'], function () {

        Route::get('/',                                         'InvoiceController@getData');
        Route::get('/clients',                                  'InvoiceController@getClients');
        Route::get('/client/{client}/orders',                   'InvoiceController@getOrders');

        // create/edit invoices
        Route::post('/client/{client}/create',                  'InvoiceController@create');
        Route::post('/{invoice}/mark-as-paid',                  'InvoiceController@markAsPaid');
        Route::post('/{invoice}/mark-as-unpaid',                'InvoiceController@markAsUnpaid');
        Route::post('/{invoice}/archive',                       'InvoiceController@archive');
        Route::post('/{invoice}/unarchive',                     'InvoiceController@unArchive');
        Route::post('/{invoice}/delete',                        'InvoiceController@delete');
        Route::post('/{invoice}/item/{item}/delete',            'InvoiceController@deleteItem');

    });

    Route::group(['namespace' => 'Settings'], function () {

        // textblocks
        Route::get('/textblocks/get-by-type/{type}',            'TextblocksController@getByType');
        Route::post('/textblocks/element/{type}',               'TextblocksController@update');

        // documents
        Route::get('/document/get-by-name/{name}',              'DocumentsController@getByName');
        Route::post('/document/{name}',                         'DocumentsController@update');
        Route::post('/document/upload',                         'DocumentsController@upload');

        // salary
        Route::post('/salary/get',                              'SalaryController@get');
        Route::post('/salary/group',                            'SalaryController@getGroup');

    });


    Route::group(['prefix' => 'user'], function() {

        Route::get('',                                          'UserController@getData');

        // user photo
        Route::post('/{user}/photo/upload',                     'UserController@uploadPhoto');
        Route::post('/{user}/photo/delete',                     'UserController@deletePhoto');

    });

    Route::get('/roles', 'RoleController@all');

    Route::post('/settings/get',                                'SettingsController@get');
    Route::get('/settings/locations',                           'SettingsController@locations');

    Route::post('/search/{term}',                               'SearchController@perform');

    Route::group(['prefix' => 'report'], function() {

        Route::get('/chart/orders',                             'ReportController@getOrderData');
        Route::get('/chart/employees-by-location',              'ReportController@getEmployeesByLocation');
        Route::get('/chart/employee-pool/{type}',               'ReportController@getEmployeePoolStatistic');
        Route::get('/chart/invoices',                           'ReportController@getInvoiceData');
//        Route::get('chart/employeeData',        'ReportController@getEmployeeData');
//        Route::get('chart/employeePoolData',    'ReportController@getEmployeePoolData');
//        Route::get('chart/invoices',            'ReportController@getInvoiceData');

    });

});

Route::group(['namespace' => 'Client\Api', 'prefix' => 'c'/*, 'middleware' => 'auth:api'*/], function () {

    Route::group(['prefix' => 'order'], function () {

        Route::post('/request',                  'OrderController@request');
        Route::post('/{order}/update',           'OrderController@update');

    });

    // calendar
    Route::post('/orders/by/month',             'CalendarController@getOrdersByMonth');
    Route::post('/orders/by/week',              'CalendarController@getOrdersByWeek');

    // contacts
    Route::get('/contacts',                     'ContactController@get');
    Route::post('/contact',                     'ContactController@store');
    Route::post('/contact/{id}',                'ContactController@update');

    Route::get('/report/chart/orders',          'ReportController@getOrderData');

    // message
    Route::post('message',                      'MessageController@send');

});


Route::group(['namespace' => 'Employee\Api', 'prefix' => 'e'/*, 'middleware' => 'auth:api'*/], function () {

    Route::get('/payroll',                       'EmployeeController@payroll');
    Route::get('/extra-business',                'EmployeeController@extraBusiness');

    // profile
    Route::get('/profile',                       'EmployeeController@get');
    Route::post('/profile',                      'EmployeeController@update');

    // calendar
    Route::post('/orders/by/month',              'CalendarController@getOrdersByMonth');
    Route::post('/orders/by/week',               'CalendarController@getOrdersByWeek');

    // order
    Route::get('/orders/requested',              'OrderController@requestedOrders');
    Route::post('/order/{order}/withdraw',       'OrderController@withdraw');
    Route::post('/order/{order}/accept',         'OrderController@accept');
    Route::post('/order/{order}/deny',           'OrderController@deny');

    // message
    Route::post('message',                       'MessageController@send');

});