@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-sm-8 offset-sm-2">     
		<div class="col-sm-12">		 
		  @if(session()->get('success'))
			<div class="alert alert-success">
			  {{ session()->get('success') }}  
			</div>
		  @endif
		  
		  @if ($errors->any())
		  <div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				  <li>{{ $error }}</li>
				@endforeach
			</ul>
		  </div><br />
		@endif
		</div>
		<div>
			<h2>{{$event->title}}</h2>
			<p><span><strong>Event Date:</strong> {{ date('d/m/Y', strtotime($event->date))}}</span></p>
			<p><span><strong>Event Category:</strong> 
			<?php 
				$ecatval = array();
				foreach($event->eventCategories as $ecat){
					$ecatval[] = $ecat->name;
				}
				echo implode(', ',$ecatval);
			?>
			</span></p>
			<p><span><strong>Event Location:</strong> {{ $event->locations->name}}</span></p>
			<p><strong>Event Description:</strong> {{$event->description}}</p>
		</div>
		
		<div class="comments">
		<h4>Comments</h4>
		@if ($event->comments->count() > 0)
		<ul>
			@foreach($event->comments as $comment)
			<li> 
				<p> {{ $comment->comment }} </p>
				<span><strong>Posted By:</strong> {{ $comment->user->name }}</span> 
				<span><strong>Posted at:</strong> {{ date('d/m/Y', strtotime($comment->created_at)) }}</span>
			</li>
			@endforeach
		</ul>
		@else
		<p>No Comments founds.</p>
		@endif
		</div>
		
		<div class="p-3">
		@auth
		<form method="post" action="{{ route('comments.store') }}">
          @csrf
			<input type="hidden" value="{{$event->id}}" name="event_id" required/>
			<input type="hidden" value="{{ \Auth::user()->id }}" name="user_id" required/>			
			<div class="form-group">    
				<label for="description">Comment:</label>
				<textarea class="form-control" name="comment" required></textarea>
			</div>			
          <button type="submit" class="btn btn-primary-outline">Add Comment</button>
		</form>
		@else
		<p style="color:red;">Please login to add your comment</p>
		@endauth
		</div>
	</div>
</div>
@endsection
