<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\IndexComponent;
use App\Http\Controllers\LoginController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::view('/','index');



Route::view('/','home');
Route::post('register',[LoginController::class,'register']);
Route::post('login',[LoginController::class,'login']);
Route::get('logout',[LoginController::class,'logout']);
Route::view('profile','profile');
Route::post('update',[LoginController::class,'update']);

Route::middleware([AuthCheck::class])->group(function(){
    Route::get('list ',[LoginController::class,'list']);
    Route::view('login','auth.login');
    Route::view('register','auth.register');
    
});
