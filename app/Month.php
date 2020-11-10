<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Month extends Model
{

    use softDeletes;

    protected $fillable = [
        'month',
        'salary_payment_day',
        'bonus_payment_day',
        'salaries_total',
        'bonus_total',
        'payments_total',
    ];

    protected $hidden = [
        'id',
    ];


    public $timestamps = false;
}
