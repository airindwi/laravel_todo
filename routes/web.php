<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChallengeController;

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
//auth
Route::middleware('isGuest')->group( function(){
    Route::get('/', [ChallengeController::class, 'login'])->name('login');
    Route::get('/register', [ChallengeController::class, 'register']);
    Route::post('/register',[ChallengeController::class,'inputRegister'])->name('register.post');
    Route::post('/login',[ChallengeController::class,'auth'])->name('login.auth');
});

Route::get('/logout',[ChallengeController::class,'logout'])->name('logout');


//todo
Route::middleware('isLogin')->prefix('/todo')->name('todo.')->group( function(){
    Route::get('/', [ChallengeController::class, 'index'])->name('index');
    Route::get('/complated', [ChallengeController::class, 'complated'])->name('complated');
    Route::get('/create', [ChallengeController::class, 'create'])->name('create');
    Route::post('/store',[ChallengeController::class,'store'])->name('store');
    Route::get('/edit/{id}',[ChallengeController::class,'edit'])->name('edit');
    Route::patch('/update/{id}',[ChallengeController::class,'update'])->name('update');
    Route::delete('/delete/{id}',[ChallengeController::class,'destroy'])->name('delete');
    Route::patch('/complated/{id}',[ChallengeController::class,'updateComplated'])->name('update-complated');
 });