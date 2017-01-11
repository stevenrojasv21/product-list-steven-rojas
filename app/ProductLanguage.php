<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Model;

class ProductLanguage extends Model
{
    protected $table = 'product_language';
    protected $collection = 'product_language';
    protected $fillable = ['title','description','product_id','language_id'];
}
