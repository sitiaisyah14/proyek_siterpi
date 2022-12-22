<?php

use App\Http\Controllers\CowHealthHistoryController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\DrughistoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FeedhistoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Artisan;
Route::get('/migrate', function () {
    Artisan::call('migrate:fresh');
    Artisan::call('db:seed');
});

Route::get('/cache-clear', function(){
    Artisan::call('cache:clear');
});
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
    return redirect()->route('home');
});

Auth::routes();

Route::group(['middleware'=>'auth'],function() {
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::resource('farm',FarmController::class);
    Route::post('farm-data',[FarmController::class,'data']);

    Route::get('farms-pdf', [FarmController::class, 'pdf'])->name('farm.pdf');
    Route::get('farms-excel', [FarmController::class, 'excel'])->name('farm.excel');

    Route::resource('employee',EmployeeController::class);
    Route::post('employee-data',[EmployeeController::class,'data']);

    Route::get('employee-pdf', [EmployeeController::class, 'pdf'])->name('employee.pdf');
    Route::get('employees-excel', [EmployeeController::class, 'excel'])->name('employee.excel');

    Route::resource('user',UserController::class);
    Route::post('user-data',[UserController::class,'data']);

    Route::resource('feed',FeedController::class);
    Route::post('feed-data',[FeedController::class,'data']);

    Route::resource('drug',DrugController::class);
    Route::post('drug-data',[DrugController::class,'data']);

    Route::resource('historydrug',DrughistoryController::class);
    Route::post('hisdrug-data',[DrughistoryController::class,'data']);
    Route::get('hisdrugs-pdf', [DrughistoryController::class, 'pdf'])->name('drughistory.pdf');
    Route::get('hisdrugs-excel', [DrughistoryController::class, 'excel'])->name('drughistory.excel');

    Route::resource('historyfeed',FeedhistoryController::class);
    Route::post('hisfeed-data',[FeedhistoryController::class,'data']);
    Route::get('hisfeeds-pdf', [FeedhistoryController::class, 'pdf'])->name('feedhistory.pdf');
    Route::get('hisfeeds-excel', [FeedhistoryController::class, 'excel'])->name('feedhistory.excel');

    Route::resource('healthfarm',CowHealthHistoryController::class);
    Route::post('healthfarm-data',[CowHealthHistoryController::class,'data']);
    Route::get('healthfarm-pdf', [CowHealthHistoryController::class, 'pdf'])->name('healthfarm.pdf');
    Route::get('healthfarm-excel', [CowHealthHistoryController::class, 'excel'])->name('healthfarm.excel');

    //ajax
    Route::get('getFeed/{id}',[HomeController::class,'getFeed']);
    Route::get('getMedicine/{id}',[HomeController::class,'getMedicine']);

});

