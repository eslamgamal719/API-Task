<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Model
{
    use softDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'salary',
        'bonus'
    ];

}
