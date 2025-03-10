<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticable
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
