<?php

namespace SONFin\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //Mass Assigment
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password'
    ];

}