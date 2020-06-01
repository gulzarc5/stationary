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

    public function subCategory()
    {
        return $this->hasMany('App\Models\Categories','parent_id',$this->primaryKey);
    }

    public function productSubCategory()
    {
        return $this->hasMany('App\Models\Product','sub_category_id',$this->primaryKey);
    }
}
