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


Route::get('/', 'Login@index');

// Login
Route::get('login', 'Login@index');
Route::post('login/cek', 'Login@cek');
Route::get('login/lupa', 'Login@lupa');
Route::get('login/logout', 'Login@logout');

Route::group(['namespace' => 'Admin'], 
function()
{
	// Devices
    Route::get('admin/devices', 'Devices@index');
    Route::post('admin/devices/tambah', 'Devices@tambah');
    Route::get('admin/devices/edit/{par1}', 'Devices@edit');
    Route::post('admin/devices/proses_edit', 'Devices@proses_edit');
    Route::get('admin/devices/delete/{par1}', 'Devices@delete');
    Route::get('admin/devices/sdelete/{par1}', 'Devices@sdelete');
    Route::post('admin/devices/proses', 'Devices@proses');
	
	// Territory
    Route::get('admin/territory', 'Territory@index');
    Route::post('admin/territory/tambah', 'Territory@tambah');
    Route::get('admin/territory/edit/{par1}', 'Territory@edit');
    Route::post('admin/territory/proses_edit', 'Territory@proses_edit');
    Route::get('admin/territory/delete/{par1}', 'Territory@delete');
    Route::get('admin/territory/sdelete/{par1}', 'Territory@sdelete');
    Route::post('admin/territory/proses', 'Territory@proses');
	
	// Territory
    Route::get('admin/transportation', 'Transportation@index');
    Route::post('admin/transportation/tambah', 'Transportation@tambah');
    Route::get('admin/transportation/edit/{par1}', 'Transportation@edit');
    Route::post('admin/transportation/proses_edit', 'Transportation@proses_edit');
    Route::get('admin/transportation/delete/{par1}', 'Transportation@delete');
    Route::get('admin/transportation/sdelete/{par1}', 'Transportation@sdelete');
    Route::post('admin/transportation/proses', 'Transportation@proses');
	
	// Fee
    Route::get('admin/fee', 'Fee@index');
    Route::post('admin/fee/tambah', 'Fee@tambah');
    Route::get('admin/fee/edit/{par1}', 'Fee@edit');
    Route::post('admin/fee/proses_edit', 'Fee@proses_edit');
    Route::get('admin/fee/delete/{par1}', 'Fee@delete');
    Route::get('admin/fee/sdelete/{par1}', 'Fee@sdelete');
    Route::post('admin/fee/proses', 'Fee@proses');
	
	// Parking Lot
    Route::get('admin/lot', 'Lot@index');
    Route::post('admin/lot/tambah', 'Lot@tambah');
    Route::get('admin/lot/edit/{par1}', 'Lot@edit');
    Route::post('admin/lot/proses_edit', 'Lot@proses_edit');
    Route::get('admin/lot/delete/{par1}', 'Lot@delete');
    Route::get('admin/lot/sdelete/{par1}', 'Lot@sdelete');
    Route::post('admin/lot/proses', 'Lot@proses');
	
	// Assigns
    Route::get('admin/assigns', 'Assigns@index');
    Route::post('admin/assigns/tambah', 'Assigns@tambah');
    Route::get('admin/assigns/edit/{par1}', 'Assigns@edit');
    Route::post('admin/assigns/proses_edit', 'Assigns@proses_edit');
    Route::get('admin/assigns/delete/{par1}', 'Assigns@delete');
    Route::get('admin/assigns/sdelete/{par1}', 'Assigns@sdelete');
    Route::post('admin/assigns/proses', 'Assigns@proses');
	
	// User Devices
    Route::get('admin/userdevices', 'Userdevices@index');
    Route::post('admin/userdevices/tambah', 'Userdevices@tambah');
    Route::get('admin/userdevices/edit/{par1}', 'Userdevices@edit');
    Route::post('admin/userdevices/proses_edit', 'Userdevices@proses_edit');
    Route::get('admin/userdevices/delete/{par1}', 'Userdevices@delete');
    Route::get('admin/userdevices/sdelete/{par1}', 'Userdevices@sdelete');
    Route::post('admin/userdevices/proses', 'Userdevices@proses');
	
	// dasbor
    Route::get('admin/dasbor', 'Dasbor@index');
    Route::get('admin/dasbor/konfigurasi', 'Dasbor@konfigurasi');
    
    // user
    Route::get('admin/user', 'User@index');
    Route::post('admin/user/tambah', 'User@tambah');
    Route::get('admin/user/edit/{par1}', 'User@edit');
    Route::post('admin/user/proses_edit', 'User@proses_edit');
    Route::get('admin/user/delete/{par1}', 'User@delete');
    Route::post('admin/user/proses', 'User@proses');
	
    // user
    Route::get('admin/resume_day', 'Resume_day@index');
    Route::get('admin/report_day/v_report_day', 'Report_day@v_report_day');
    Route::get('admin/report_day/r_report_day', 'Report_day@r_report_day');
    Route::get('admin/report_day/v_report_rekap', 'Report_day@v_report_rekap');
    Route::get('admin/report_day/r_report_rekap', 'Report_day@r_report_rekap');
    Route::get('admin/report_day/r_report_rekap_a', 'Report_day@r_report_rekap_a');
    Route::get('admin/report_day/r_report_rekap_w', 'Report_day@r_report_rekap_w');
    
});




