<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Yuyue extends Model
{
    protected $table = "yuyues";
    
    protected $guarded = [];
	
    public $timestamps = true;

    protected function getDateFormat()
    {
	return time();
    }

    protected function asDateTime($val)
    {
	return $val;
    }
    
}
