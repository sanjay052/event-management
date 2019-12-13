<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $fillable = ['title','slug','date','location_id','category','description'];
	
	public function comments()
    {
        return $this->hasMany(Comment::class);
    }
	
	public function locations()
    {
        return $this->belongsTo('App\Location', 'location_id', 'id');
    }
	
	public function eventCategories()
    {
        return $this->belongsToMany(Category::class,'event_categories','event_id','category_id');
    } 
} 	