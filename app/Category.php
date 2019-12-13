<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $fillable = ['name'];
	
	public function eventCategory()
    {
        return $this->hasMany(EventCategory::class);
    }
	
	public static function showCategoryName($id){
		$category = Category::find($id);
		return $category;
	}
}
