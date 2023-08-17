<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Task\TaskTypeController;
use App\Http\Controllers\API\Designation\DesignationController;
use App\Http\Controllers\API\Project\ProjectController;
use App\Http\Controllers\API\Employee\EmployeeController;
use App\Http\Controllers\API\User\UserController;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/confirm-email/{user_id}/{key}', [AuthController::class, 'confirmMail']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'v1'], function () {
        Route::post('/task-type/get-all', [TaskTypeController::class, 'index']);

        Route::post('/designation/get-all', [DesignationController::class, 'index']);

        Route::post('/project/create', [ProjectController::class, 'store']);
        Route::post('/project/get-all', [ProjectController::class, 'index']);
        Route::get('/project/{id}', [ProjectController::class, 'findById']);

        Route::post('/employee/create', [EmployeeController::class, 'store']);
        Route::post('/employee/get-all', [EmployeeController::class, 'index']);
        Route::get('/employee/{id}', [EmployeeController::class, 'findById']);

        Route::post('/user/get-all', [UserController::class, 'index']);
        Route::get('/user/{id}', [UserController::class, 'findById']);

        Route::post('/logout', [AuthController::class, 'logout']);

    });
});

