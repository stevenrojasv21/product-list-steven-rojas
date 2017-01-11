<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Model;

class Language extends Model
{
    //
    public $incrementing = false;
    protected $table = 'language';
    protected $collection = 'language';
    protected $fillable = ['id'];
}
