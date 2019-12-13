<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public $fillable = ['name'];
	
	public function events()
    {
        return $this->hasMany(Event::class, 'location_id');
    }
}
