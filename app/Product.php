<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Model;

class Product extends Model
{
    //
    protected $table = 'product';
    protected $collection = 'product';
    protected $fillable = ['product_code'];
    
    function productLanguage() {
        return $this->hasMany('App\ProductLanguage');
    }
    
}
