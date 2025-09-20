<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Pages\Student;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Pages START
Route::prefix('student')->group(function () {
    Route::post('/create_student', [Student::class, 'createStudent']);
});
// Pages START