<?php


use Core\BoundedContext\Course\Infrastructure\Controller\{
    CreateCoursePostController,
    ListCourseGetController
};
use Illuminate\Support\Facades\Route;

Route::post('courses',  CreateCoursePostController::class);
Route::get('courses',  ListCourseGetController::class);
