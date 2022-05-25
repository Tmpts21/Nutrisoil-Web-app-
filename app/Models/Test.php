<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use User; 
use Content; 

class Test extends Model
{
    use HasFactory;

    protected $guarded = []; 

    public function contents() { 
        return $this->hasMany('App\Models\Content'); 
    }

    public function user() { 
        return $this->belongsTo(User::class ); 
    }
}
