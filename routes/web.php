<?php

use App\Http\Controllers\AreasController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\CotizacionesController;
use App\Http\Controllers\FormatosController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\OvController;
use Illuminate\Support\Facades\Route;

Route::resource('/areas', AreasController::class);
Route::resource('/clientes', ClientesController::class);
Route::resource('/entregables', FormatosController::class);
Route::resource('/ov', OvController::class);
Route::resource('/marcas', MarcasController::class);
Route::resource('/cotizaciones', CotizacionesController::class);
Route::resource('/items', ItemsController::class);