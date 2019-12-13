@extends('layouts.app')
@section('content')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Add a Event</h1>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif 
      <form method="post" action="{{ route('events.store') }}">
          @csrf
			<div class="form-group">    
				<label for="title">Title:</label>
				<input type="text" class="form-control" name="title" required/>
			</div>
			<div class="form-group">    
				<label for="date">Event Date:</label>
				<input type="date" class="form-control" name="date" required/>
			</div>
			<div class="form-group">    
				<label for="location_id	">Location:</label>
				<select name="location_id"  class="form-control">
					@foreach ($locations as $location)
					<option value="{{$location->id}}">{{$location->name}}</option> 
					@endforeach
				</select> 
			</div>
			<div class="form-group">    
				<label for="category">Category:</label>
				<select name="category[]" multiple  class="form-control">
					@foreach ($categories as $category)
					<option value="{{$category->id}}">{{$category->name}}</option> 
					@endforeach
				</select> 
			</div>
			<div class="form-group">    
				<label for="description">Description:</label>
				<textarea class="form-control" name="description" required></textarea>
			</div>			
          <button type="submit" class="btn btn-primary-outline">Add Event</button>
      </form>
  </div>
</div>
</div>
@endsection
