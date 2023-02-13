<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\FilterController;

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

Route::get('/', [FilterController::class,'index']);

// Route to get the whole sellers for a supplier
Route::get('/getWholeSellers/{supplier_id}', [FilterController::class,'getWholeSellers'])->name('getWholeSellers');

// Route to get the car models for a steering type
Route::get('/getCarModels/{steering_type_id}', [FilterController::class,'getCarModels'])->name('getCarModels');

// Route to get the car SFXs for a car model
Route::get('/getCarSFXs/{car_model_id}', [FilterController::class,'getCarSFXs'])->name('getCarSFXs');

// Route to get the car variants for a car model and car SFX
Route::post('/getCarVariant', [FilterController::class,'getCarVariants'])->name('getCarVariant');

// Route to get the colors for the selected filters
Route::post('/getColor', [FilterController::class,'getColor'])->name('getColor');

// Route to get the filtered data based on the selected filters
Route::post('/filtered-data', [FilterController::class, 'getFilteredData'])->name('getFilteredData');

// Route to save the edited table data
Route::post('/save-table', [FilterController::class,'saveTableData'])->name('saveTableData');