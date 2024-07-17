<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $fillable=['title','logo','company','location','website','email','tag','description'];
    public function scopeFilter($query, array $filters){
        if($filters['tag'] ?? false){
            $query->where('tag', 'like',  '%' .request('tag').'%');
        }
        if($filters['search']??false){
            $query->where('title', 'like',  '%' .request('search').'%')
            ->orWhere('description', 'like',  '%' .request('search').'%')
            ->orWhere('tag', 'like',  '%' .request('search').'%');
        }
    }
    //relationship with user
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
