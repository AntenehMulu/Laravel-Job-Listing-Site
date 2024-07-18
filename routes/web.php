<?php

use App\Models\Article;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

//Routing
// Route::get('/hello',function(){
//     return response('<h1>hello world</h1>',200)
//     ->header('Content-Type','text/plain')
//     ->header('foo','bar');
// });
// //wild card
// Route::get('/user/{id}', function($id){
//     return response('user id '. $id);
// })->where('id', '[0-9]+');
// Route::get('/posts/{postId}/comments/{commentId}', function ($postId, $commentId){
//     return 'post id'.$postId .'comment Id'. $commentId;
// });
// Route::get('/search',function(Request $request){
//     dd($request->name);
// });
//Display all list
Route::get('/',[ListingController::class, 'index']);
//create form
Route::get('/listings/create',[ListingController::class, 'create'])->name('listings.create')->middleware('auth');
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');
//Single List
Route::get('/listings/{listing}',[ListingController::class,'show']);
//store
Route::Post('/listings',[ListingController::class,'store'])->name('listings.store')->middleware('auth');
//edit
Route::get('/listings/{listing}/edit',[ListingController::class,'edit'])->name('listings.edit')->middleware('auth');
//update the gig info
Route::put('/listings/{listing}',[ListingController::class,'update'])->name('listings.update')->middleware('auth');
//delete the gig
Route::delete('/listings/{listing}',[ListingController::class,'destroy'])->name('listings.delete')->middleware('auth');

//user manangement
Route::get('/register',[UserController::class,'register'])->middleware('guest');
//add new user
Route::post('/users', [UserController::class,'store']);
//logout
Route::post('/logout',[UserController::class,'logout'])->middleware('auth');
//login form
Route::get('/login',[UserController::class,'login'])->name('login');
//login user
Route::post('/users/authenticate',[UserController::class, 'authenticate']);
