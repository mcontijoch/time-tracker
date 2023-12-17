<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \Apps\Web\Controller\HealthCheckController::class);
