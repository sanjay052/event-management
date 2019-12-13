<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    public $fillable = ['event_id','category_id'];
	
	public static function saveEventCategory($eventId, $category){
		self::where('event_id', $eventId)->delete();
		if(!empty($category)){
			foreach($category as $cat){
				$eventCategory = new EventCategory([
				'event_id'		=> $eventId,
				'category_id' 	=> $cat			
				]);
				$eventCategory->save();
			}	
		}
	}
	
	public static function getEventCategory($id){
		$catNames = array();
		$model = self::where('event_id', $id)->pluck('category_id');
		$categoryData = Category::showCategoryName($model);
		foreach($categoryData as $cat){
			$catNames[] = $cat->id;
		}
		return $catNames; 
	}
	
}
