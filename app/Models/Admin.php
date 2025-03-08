<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'password',
        'address',
        'telephone',
        'birthday_date',
        'cpf',
        'photo', // opcional
    ];
}
