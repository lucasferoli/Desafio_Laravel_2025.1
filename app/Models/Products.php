<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $fillable = [
        'id', 
        'photo', 
        'name', 
        'price', 
        'quantity', 
        'description', 
        'category', 
        'advertiser_id'
    ];
}
