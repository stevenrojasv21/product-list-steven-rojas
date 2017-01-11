<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductLanguage extends Model
{
    protected $table = 'product_language';
    protected $fillable = ['title','description','product_id','language_id'];
}
