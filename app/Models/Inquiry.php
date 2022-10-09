<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'email', 'about', 'details', 'status', 'responder'];


    public function scopeFilter($query, array $filters){
        //searchbar
        if($filters['search'] ?? false){
            $query->where('details', 'like', '%' . request('search') . '%')
                ->orWhere('name', 'like', '%' . request('search') . '%')
                ->orWhere('about', 'like', '%' . request('search') . '%');
        }
    }
}
