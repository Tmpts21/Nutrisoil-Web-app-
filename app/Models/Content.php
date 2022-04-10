<?php

namespace App\Models;
use Test; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function test(){ 
        return $this->belongsTo(Test::class) ;
    }
}
