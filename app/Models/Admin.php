<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'id',
        'name',
        'password',
        'senha',
        'address',
        'telephone',
        'birthday_date',
        'cpf',
        'photo', // opcional
    ];
}
