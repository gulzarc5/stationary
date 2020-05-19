<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;

class Categories extends Model
{
    use LaratrustUserTrait;
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'slug', 'parent_id','level','status','image',
    ];

    public function mainCategory()
    {
        return $this->belongsTo('App\Models\Categories','parent_id',$this->primaryKey);
    }
}
