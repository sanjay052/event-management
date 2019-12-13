@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-sm-8 offset-sm-2">
		<h1 class="display-3">Categories</h1>    
		<div class="col-sm-12"> 
		  @if(session()->get('success'))
			<div class="alert alert-success">
			  {{ session()->get('success') }}  
			</div>
		  @endif
		</div>
		<div>
			<a style="margin: 19px;" href="{{ route('categories.create')}}" class="btn btn-success">New Category</a>
		</div>
		  <table id="example" class="table  table-striped">
			<thead>
				<tr>
				  <td>ID</td>
				  <td>Name</td> 
				  <td>Event Count</td> 
				  <td width="140px">Actions</td>
				</tr>
			</thead>
			<tbody>
				@foreach($categories as $category)
				<tr>
					<td>{{$category->id}}</td>
					<td>{{$category->name}}</td> 
					<td>{{$category->eventCategory->count()}}</td>
					<td>
						<a href="{{ route('categories.edit',$category->id)}}" class="btn btn-primary">Edit</a> 
						<form style="float:right;" action="{{ route('categories.destroy', $category->id)}}" method="post">
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
