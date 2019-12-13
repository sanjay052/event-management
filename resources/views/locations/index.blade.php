@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-sm-8 offset-sm-2">
		<h1 class="display-3">Locations</h1>    
		<div class="col-sm-12">
			@if(session()->has('errorMessage'))
				<div class="alert alert-danger">
					{{ session()->get('errorMessage') }}
				</div>
			@endif
			@if(session()->get('success'))
				<div class="alert alert-success">
				  {{ session()->get('success') }}  
				</div>
			@endif
		</div>
		<div>
			<a style="margin: 19px;" href="{{ route('locations.create')}}" class="btn btn-success">New Location</a>
		</div>
		  <table id="example" class="data-table table table-striped">
			<thead>
				<tr>
				  <td>ID</td>
				  <td>Name</td> 
				  <td>Event Count</td> 
				  <td width="140px">Actions</td>
				</tr>
			</thead>
			<tbody>
				@foreach($locations as $location)
				<tr>
					<td>{{$location->id}}</td>
					<td>{{$location->name}}</td> 
					<td>{{$location->events_count}}</td> 
					<td>
						<a href="{{ route('locations.edit',$location->id)}}" class="btn btn-primary">Edit</a> 
						<form style="float:right;" action="{{ route('locations.destroy', $location->id)}}" method="post">
						  @csrf
						  @method('DELETE')
						  <button class="btn btn-danger" type="submit">Delete</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		  </table> 
		
	</div>
</div>

@endsection
