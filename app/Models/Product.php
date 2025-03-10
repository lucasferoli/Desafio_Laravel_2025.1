<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'product';
    
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

    public function advertiser()
    {
        return $this->belongsTo(User::class, 'advertiser_id');
    }
}