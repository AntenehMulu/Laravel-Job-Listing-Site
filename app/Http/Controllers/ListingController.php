<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;
use Symfony\Contracts\Service\Attribute\Required;

class ListingController extends Controller
{
    public function index(){
        return view('listings.index',
        ['heading'=>'Latest Listings',
        'listings'=>Listing::latest()->filter(request(['tag', 'search']))->Paginate(4)
        ]
    );
    }
    public function show(Listing $listing){
        return view('listings.show',['listing'=>$listing]);

    }
    public function create(){
        return view('listings.create');
    }
    public function store(Request $request){
        $data = $request->validate([
            'title'=>'required',
            'company'=>['required',Rule::unique('listings','company')],
            'location'=>'required',
            'website'=>'required',
            'email'=>'email',
            'tag'=>'required',
            'description'=>'required'
        ]);

        if($request->hasFile('logo')){
            $data['logo']=$request->file('logo')->store('images', 'public');
        }
        $data['user_id'] = Auth::id();
        Listing::create($data);
        return redirect('/')->with('message','Listing created Succesfully!');
    }
    public function edit(Listing $listing){
        if($listing->user_id != auth()->id()){
            abort(403,'unauthorized action');
        }
        return view('listings.edit',['listing'=>$listing]);
    }
    public function update(Listing $listing, Request $request){
        if($listing->user_id != auth()->id()){
            abort(403,'unauthorized action');
        }
        $data = $request->validate([
            'title'=>'required',
            'company'=>['required'],
            'location'=>'required',
            'website'=>'required',
            'email'=>'email',
            'tag'=>'required',
            'description'=>'required'
        ]);
        if($request->hasFile('logo')){
            $data['logo']=$request->file('logo')->store('images', 'public');
        }
        $listing->update($data);

        return back()->with('message','Listing created Succesfully!');

    }
    public function destroy(Listing $listing){
        if($listing->user_id != auth()->id()){
            abort(403,'unauthorized action');
        }
        $listing->delete();
        return redirect('/');
    }
    public function manage(){
        return view('listings.manage',['listings'=>auth()->user()->listings()->get()]);
    }
    //
}
