<?php

use App\Http\Controllers\AreasController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\CotizacionesController;
use App\Http\Controllers\EntregablesController;
use App\Http\Controllers\FormatosController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\OvController;
use App\Http\Controllers\TargetsController;
use Illuminate\Support\Facades\Route;

Route::resource('/areas', AreasController::class);
Route::resource('/clientes', ClientesController::class);
Route::resource('/entregables', EntregablesController::class);
Route::resource('/formatos', FormatosController::class);
Route::resource('/ov', OvController::class);
Route::resource('/marcas', MarcasController::class);
Route::resource('/cotizaciones', CotizacionesController::class);
Route::resource('/items', ItemsController::class);
Route::resource('/targets', TargetsController::class);