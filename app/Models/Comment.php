<?php

namespace App\Models;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    public function listing(){
        return $this->belongsTo(Listing::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
