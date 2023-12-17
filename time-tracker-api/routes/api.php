<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \Apps\Web\Controller\HealthCheckController::class);
Route::get('/tasks', \Apps\Web\Controller\GetTasksController::class);
