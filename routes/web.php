<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/hello',function(){
    return response('<h1>hello world</h1>',200)
    ->header('Content-Type','text/plain')
    ->header('foo','bar');
});
// Route::get('/posts/{id}',function($id){
//     dd($id);
//     return response('Post '. $id);
// });
Route::get('/search',function(Request $request){
    return $request->city;
});
//Display all list
Route::get('/listings', function () {
    return view('listings',
    ['heading'=>'Latest Listings',
    'listings'=>Listing::all()
    ]
);
});
//Single List
Route::get('/listings/{listing}',function(Listing $listing){
    return view('listing',['listing'=>$listing]);
});