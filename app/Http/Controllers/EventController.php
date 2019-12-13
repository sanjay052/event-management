<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Category;
use App\Location;
use App\EventCategory;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		
		//print_r($request->all()); die;
		$name = $request->input('name');
		$date = $request->input('date');		
        $events = Event::with('eventCategories')->where('title', 'LIKE', '%' . $name . '%')->orWhere('date',$date)->get();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
		$categories = Category::all();
		$locations = Location::all();
        return view('events.create',compact('categories','locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
		$request->request->add(['slug' => $this->createSlug($request->get('title'))]); 
		$category = $request->get('category');
		
        $request->validate([
            'title'=>'required', 
			'location_id'=>'required',
			'description'=>'required',
			'date'=>'required|date_format:Y-m-d'
        ]);

        $event = new Event([
            'title'			=> $request->get('title'),
            'slug' 			=> $request->get('slug'),
            'location_id' 	=> $request->get('location_id'), 
            'description' 	=> $request->get('description'),
            'date' 			=> $request->get('date')
			
        ]);
        $event->save();
		$eventId = $event->id;
		EventCategory::saveEventCategory($eventId,$category);        
        return redirect('/events')->with('success', 'Event saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['event'] = Event::where('slug', '=', $id)->firstOrFail();
		return view('events.show',$data);
		//print_r($event); die;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$categories = Category::all();
		$locations = Location::all();
        $event = Event::find($id);
        $eventCategory = EventCategory::getEventCategory($id);
        return view('events.edit', compact('event','categories','locations','eventCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  
		$category 	=  $request->get('category');
        $request->validate([
            'title'=>'required', 
			'location_id'=>'required',
			'description'=>'required',
			'date'=>'required|date_format:Y-m-d'
        ]);

        $event = Event::find($id);
        $event->title 		=  $request->get('title'); 
        $event->location_id =  $request->get('location_id');  
        $event->description =  $request->get('description'); 
        $event->date 		=  $request->get('date'); 
        $event->save();
		EventCategory::saveEventCategory($id,$category);
        return redirect('/events')->with('success', 'Event updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();

        return redirect('/events')->with('success', 'Event deleted!');
    }
	
	public function createSlug($title, $id = 0){
	// Normalize the title
	$slug = str_slug($title);
	
	$allSlugs = $this->getRelatedSlugs($slug, $id);

	if (! $allSlugs->contains('slug', $slug)){
		return $slug;
	}

	// Just append numbers like a savage until we find not used.
	for ($i = 1; $i <= 10; $i++) {
		$newSlug = $slug.'-'.$i;
		if (! $allSlugs->contains('slug', $newSlug)) {
			return $newSlug;
		}
	}

	throw new \Exception('Can not create a unique slug');
}

	public function getRelatedSlugs($slug, $id = 0){
		return \DB::table('events')->select('slug')->where('slug', 'like', $slug.'%')
			->where('id', '<>', $id)
			->get();
	}
}
