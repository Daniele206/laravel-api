<?php

use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\LeadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/projects', [PageController::class, 'projects']);
Route::get('/technologies', [PageController::class, 'technologies']);
Route::get('/types', [PageController::class, 'types']);
Route::get('/project/{slug}', [PageController::class, 'projectShow']);
Route::post('/send-email', [LeadController::class, 'store']);
