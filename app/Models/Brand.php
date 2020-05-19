<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;

class Brand extends Model
{
    use LaratrustUserTrait;
    protected $table = 'brands';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'slug', 'category_id','status ',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Categories','category_id');
    }

}
