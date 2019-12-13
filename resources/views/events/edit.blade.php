@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Update a Event</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif 
		<form method="post" action="{{ route('events.update', $event->id) }}">
		 @method('PATCH') 
          @csrf
			<div class="form-group">    
				<label for="title">Title:</label>
				<input type="text" class="form-control" name="title" required value="{{ $event->title }}"/>
			</div>
			<div class="form-group">    
				<label for="date">Event Date:</label>
				<input type="date" class="form-control" name="date" required value="{{ $event->date }}"/>
			</div>
			<div class="form-group">    
				<label for="location_id	">Location:</label>
				<select name="location_id"  class="form-control">
					@foreach ($locations as $location)
					<option <?php if ($location->id == $event->location_id) echo ' selected="selected"'; ?> value="{{$location->id}}">{{$location->name}}</option> 
					@endforeach
				</select> 
			</div>
			<div class="form-group">    
				<label for="category">Category:</label>
				<select name="category[]"  multiple  class="form-control">
					@foreach ($categories as $category)
					<option  <?php if (in_array($category->id, $eventCategory)) echo ' selected="selected"'; ?> value="{{$category->id}}">{{$category->name}}</option> 
					@endforeach
				</select> 
			</div>
			<div class="form-group">    
				<label for="description">Description:</label>
				<textarea class="form-control" name="description" required >{{ $event->description }}</textarea>
			</div>			
          <button type="submit" class="btn btn-primary">Update</button>
      </form>
	  
	  
        
    </div>
</div>
@endsection
