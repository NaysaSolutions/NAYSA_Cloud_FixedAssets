<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// GET: http://localhost:8000/api/users
Route::get("index", [App\Http\Controllers\FA_CATEGController::class, 'index']);

 // POST: http://localhost:8000/api/users
Route::post("upsert", [App\Http\Controllers\FA_CATEGController::class, 'upsert']);

 // GET: http://localhost:8000/api/users/{user}
Route::get("show/{user}", [App\Http\Controllers\FA_CATEGController::class, 'show']);

// DELETE: http://localhost:8000/api/users/{user}
Route::delete("delete/{id}", [App\Http\Controllers\FA_CATEGController::class, 'delete']);
 //});

 //     // PATCH: http://localhost:8000/api/users/{user}
    // Route::patch("update/{user}", [App\Http\Controllers\UserController::class, 'update']);

// Route::prefix("users")->group(function () {
//     // POST: http://localhost:8000/api/users
//     Route::post("/", [App\Http\Controllers\UserController::class, 'store']);
    
//    

//     // DELETE: http://localhost:8000/api/users/{user}
//     Route::delete("/{user}", [App\Http\Controllers\UserController::class, 'destroy']);
// });

// // POST: http://localhost:8000/api/login
// Route::post("/login", [App\Http\Controllers\AuthController::class, 'login']);