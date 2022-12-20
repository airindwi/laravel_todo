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


//halaman admin
Route::middleware(['isLogin', 'CekRole:admin'])->group(function(){
    Route::get('/todo/data', [ChallengeController::class,'userData'])->name('todo.data');
});

//halaman untuk user dan admin
Route::middleware(['isLogin', 'CekRole:admin,user'])->group(function(){
    Route::get('/todo/', [ChallengeController::class,'index'])->name('todo.index');
    Route::get('/todo/profile', [ChallengeController::class,'profile'])->name('todo.profile');
    Route::get('/error',[ChallengeController::class,'error'])->name('error');
    Route::get('/todo/profile/upload',[ChallengeController::class,'updateProfile'])->name('todo.profile.update');
    Route::get('/todo/profile/change',[ChallengeController::class,'profileChange'])->name('todo.profile.change');
});


//todo
Route::middleware(['isLogin', 'CekRole:user'])->prefix('/todo')->name('todo.')->group( function(){
    // Route::get('/', [ChallengeController::class, 'index'])->name('index');
    Route::get('/complated', [ChallengeController::class, 'complated'])->name('complated');
    Route::get('/create', [ChallengeController::class, 'create'])->name('create');
    Route::post('/store',[ChallengeController::class,'store'])->name('store');
    Route::get('/edit/{id}',[ChallengeController::class,'edit'])->name('edit');
    Route::patch('/update/{id}',[ChallengeController::class,'update'])->name('update');
    Route::delete('/delete/{id}',[ChallengeController::class,'destroy'])->name('delete');
    Route::patch('/complated/{id}',[ChallengeController::class,'updateComplated'])->name('update-complated');
    // Route::get('/profile',[ChallengeController::class,'profile'])->name('profile');
    // Route::get('/data',[ChallengeController::class,'data'])->name('data');
});