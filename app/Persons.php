<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persons extends Model
{
    protected $fillable = [
        'email', 'name', 'phone', 'message', 'status'
    ];
}
