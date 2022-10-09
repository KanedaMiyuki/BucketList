<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relationship With Listings
    public function listings(){
        return $this->hasMany(Listing::class);
    }
    //Relationship With Comment
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function scopeFilter($query, array $filters){
        //searchbar
        if($filters['search'] ?? false){
            $query->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('id', 'like', '%' . request('search') . '%');
        }
    }
}
