<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name_kr',
        'phone',
        'email',
        'birthday',
        'gender',
        'name_en',
        'passport_no',
        'passport_expiry',
        'history',
        'memo',
    ];
}
