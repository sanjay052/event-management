@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-sm-8 offset-sm-2">
		<h1 class="display-3">Events</h1>    
		<div class="col-sm-12">

		  @if(session()->get('success'))
			<div class="alert alert-success">
			  {{ session()->get('success') }}  
			</div>
		  @endif
		</div>
		@if(\Auth::user())
		@if(\Auth::user()->role_id == 1)
		<div>
			<a style="margin: 19px;" href="{{ route('events.create')}}" class="btn btn-success">New Event</a>
		</div>
		@endif
		@endif
			<div>
				<form>
					<div class="col-sm-4">
						<div class="form-group">
							<label>Name</label>
							<input class="form-control" type="text" value="" name="name" required/>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label>Event Date</label>
							<input class="form-control" type="date" value="" name="date" required/>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label>&nbsp;</label>
							<input class="form-control btn btn-primary" type="submit" value="Search"/>
						</div>
					</div>
				</form>
			</div>
			<div class="clearfix"></div>
		  <table width="100%" id="example" class="table table-striped">
			<thead>
				<tr> 
				  <td>Name</td> 
				  <td>Event Date</td> 
				  <td>Locations</td> 
				  <td>Categories</td> 
				  <td width="200px">Actions</td>
				</tr>
			</thead>
			<tbody>
			<?php //echo "<pre>"; print_r($events); die;?>
				@foreach($events as $event)
				
				<tr> 	
					<td>{{$event->title}}</td> 
					<td>{{ date('d/m/Y', strtotime($event->date))}}</td> 
					<td>{{$event->locations->name}}</td> 
					<td> 	
						<?php 
							$ecatval = array();
							foreach($event->eventCategories as $ecat){
								$ecatval[] = $ecat->name;
							}
							echo implode(', ',$ecatval);
						?>
					</td> 
					<td>
						<a href="{{ route('events.show',$event->slug	)}}" class="btn btn-secondary">View</a>
						@if(\Auth::user())
						@if(\Auth::user()->role_id == 1)
						<a href="{{ route('events.edit',$event->id)}}" class="btn btn-primary">Edit</a> 
						<form style="float:right;" action="{{ route('events.destroy', $event->id)}}" method="post">
						  @csrf
						  @method('DELETE')
						  <button class="btn btn-danger" type="submit">Delete</button>
						</form>
						@endif
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		  </table> 
	</div>
</div>
@endsection
