
<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);

Route::resource('invoices', 'InvoicesController');
Route::get('/invoices/{order?}', 'InvoicesController@index')->name('invoices.index');
Route::get('/invoices/sort/{order?}/{column?}', 'InvoicesController@sort')->name('invoices.sort');

Route::get('/invoices/sortDueDate/{order?}/{column?}', 'InvoicesController@sortDueDate')->name('invoices.sortDueDate');

Route::get('/invoices/sortUnpaid/{order?}/{column?}', 'InvoicesController@sortUnpaid')->name('invoices.sortUnpaid');

Route::get('/invoices/sortUnpaidDueDate/{order?}/{column?}', 'InvoicesController@sortUnpaidDueDate')->name('invoices.sortUnpaidDueDate');

Route::get('/invoices/sortPaid/{order?}/{column?}', 'InvoicesController@sortPaid')->name('invoices.sortPaid');

Route::match(['get', 'patch'], 'invoices/edit/{idinvoice}', 'InvoicesController@edit')->name('invoices.edit');

Route::post('populateCounterData', 'InvoicesController@populateCounterData')->name('populateCounterData');

Route::get('getCounterInfo', 'InvoicesController@getCounterInfo')->name('getCounterInfo');

// Add this route to handle the local statistics view

//Route::get('/getCounterInfo/{counterReferenceId}', 'InvoicesController@getCounterInfo')->name('getCounterInfo');

Route::post('generate', 'HomeController@generate')->name('generate');

//redirection new test
Route::get('invoices/new-page/{idinvoice}', 'InvoicesController@getCounterDetails')->name('invoices.new-page');

Route::get('counter/counter-stat/{CounterReferenceid}', 'CounterController@getCounterStats')->name('counter.counter-stats');

Route::patch('invoices/edit/{idinvoice}', 'InvoicesController@update')->name('invoices.update');

Route::get('Invoice_Paid', 'InvoicesController@Invoice_Paid');

Route::get('Invoice_UnPaid', 'InvoicesController@Invoice_UnPaid');

Route::get('Other', 'InvoicesController@Other');

//Route::get('Print_invoice/{idinvoice}', 'InvoicesController@printInvoice');

Route::get('invoices/printInvoice/{idinvoice}', 'InvoicesController@printInvoice')->name('invoices.printInvoice');


Route::resource('districts', 'DistrictController');

Route::resource('locality_family', 'LocalityFamilyController');


Route::resource('subfamily', 'SubFamilyController');


Route::resource('countertype', 'CounterTypeController');


Route::resource('location', 'LocationsController');

Route::resource('counter', 'CounterController');



Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');
});


Route::get('MarkAsRead_all', 'InvoicesController@MarkAsRead_all')->name('MarkAsRead_all');

Route::get('unreadNotifications_count', 'InvoicesController@unreadNotifications_count')->name('unreadNotifications_count');

Route::get('unreadNotifications', 'InvoicesController@unreadNotifications')->name('unreadNotifications');

Route::get('/{page}', 'AdminController@index');

//traduction
Route::get('change-language/{locale}', 'LanguageController@changeLanguage')->name('changeLanguage');

//tabulation
Route::get('/tab1', function () {

    return view('/invoices/new-page');
});

Route::get('/tab2', function () {

    return view('/new-page');
});

Route::get('/tab3', function () {

    return view('/invoices/new-page');
});


Route::get('/invoices/new-page/{counterReference}', 'InvoiceController@showInvoicesWithSameCounterReference')->name('showInvoicesWithSameCounterReference');

//Invoice Details
Route::get('invoices/InvoiceDeatils/{idinvoice}', 'InvoicesController@InvoiceDeatils')->name('invoices.InvoiceDeatils');
