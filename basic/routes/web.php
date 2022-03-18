<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\DB;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/about',[ContactController::class,"index"]);


// Middleware

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $user = User::all();
    // $user = DB::table('users')->get();

    return view('admin.index');
})->name('dashboard');



Route::get('/category/all',[CategoryController::class,"AllCat"])->name('all_category');
Route::get('category/edit/{id}',[CategoryController::class,"Edit"]);
Route::get('category/softdelete/{id}',[CategoryController::class,"SoftDelete"]);
Route::get('category/restore/{id}',[CategoryController::class,"Restore"]);
Route::get('category/pdelete/{id}',[CategoryController::class,"Pdelete"]);
Route::post('category/update/{id}',[CategoryController::class,"Update"]);
Route::post('/category/add',[CategoryController::class,"AddCat"])->name('store');


// Brand Route

Route::get('/brand/all',[BrandController::class,"AllBrand"])->name('all_brand');
Route::post('/brand/add',[BrandController::class,"StoreBrand"])->name('store.brand');
Route::get('brand/edit/{id}',[BrandController::class,"Edit"]);
Route::post('brand/update/{id}',[BrandController::class,"Update"]);
Route::get('brand/delete/{id}',[BrandController::class,"Delete"]);