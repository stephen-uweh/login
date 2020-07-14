<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Vendor extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    protected $hidden = [
        'password',
    ];

}
