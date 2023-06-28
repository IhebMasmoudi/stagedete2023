<?php

use Illuminate\Support\Facades\Route;

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

Route::resource('invoices', 'InvoicesController');

Route::match(['get', 'patch'], 'invoices/edit/{idinvoice}', 'InvoicesController@edit')->name('invoices.edit');


Route::patch('invoices/edit/{idinvoice}', 'InvoicesController@update')->name('invoices.update');

Route::get('Invoice_Paid','InvoicesController@Invoice_Paid');

Route::get('Invoice_UnPaid','InvoicesController@Invoice_UnPaid');

Route::get('Invoice_other','InvoicesController@Invoice_UnPaid');





Route::resource('districts', 'DistrictController');

Route::resource('locality_family', 'LocalityFamilyController');


Route::resource('subfamily', 'SubFamilyController');


Route::resource('countertype', 'CounterTypeController');


Route::resource('location', 'LocationsController');

Route::resource('counter', 'CounterController');


Route::get('/{page}', 'AdminController@index');
