<?php

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

Route::match(['get', 'patch'], 'invoices/edit/{idinvoice}', 'InvoicesController@edit')->name('invoices.edit');

Route::post('populateCounterData', 'InvoicesController@populateCounterData')->name('populateCounterData');

Route::get('getCounterInfo', 'InvoicesController@getCounterInfo')->name('getCounterInfo');


Route::post('generate', 'HomeController@generate')->name('generate');


Route::patch('invoices/edit/{idinvoice}', 'InvoicesController@update')->name('invoices.update');

Route::get('Invoice_Paid','InvoicesController@Invoice_Paid');

Route::get('Invoice_UnPaid','InvoicesController@Invoice_UnPaid');

Route::get('Other','InvoicesController@Other');

//Route::get('Print_invoice/{idinvoice}', 'InvoicesController@printInvoice');

Route::get('invoices/printInvoice/{idinvoice}', 'InvoicesController@printInvoice')->name('invoices.printInvoice');


Route::resource('districts', 'DistrictController');

Route::resource('locality_family', 'LocalityFamilyController');


Route::resource('subfamily', 'SubFamilyController');


Route::resource('countertype', 'CounterTypeController');


Route::resource('location', 'LocationsController');

Route::resource('counter', 'CounterController');



Route::get('/home', 'HomeController@index')->name('home');
   
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
   
});


Route::get('MarkAsRead_all','InvoicesController@MarkAsRead_all')->name('MarkAsRead_all');

Route::get('unreadNotifications_count', 'InvoicesController@unreadNotifications_count')->name('unreadNotifications_count');

Route::get('unreadNotifications', 'InvoicesController@unreadNotifications')->name('unreadNotifications');

Route::get('/{page}', 'AdminController@index');