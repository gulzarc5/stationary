<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;

class Address extends Model
{
    use LaratrustUserTrait;
    protected $table = 'address';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id', 'name', 'state','city','email','mobile','address','pin',
    ];
}
