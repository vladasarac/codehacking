@extends('layouts.admin')

@section('content')
  
  {{--lekcija: 29 - Application - Categories - 239.Creating categories.mp4--}}
  <h1>Categories</h1>
  
  {{--u ovom divu je forma za editovanje postojece kategorije salje uneto update() metodu AdminCategoriesController-a--}}
  <div class="col-sm-6">
    {!! Form::model($category, ['method'=>'PATCH', 'action'=>['AdminCategoriesController@update', $category->id]]) !!}
	  <div class="form-group">
	  {!! Form::label('name', 'Name:') !!}
	  {!! Form::text('name', null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">	  
	  {!! Form::submit('Update Category', ['class'=>'btn btn-primary']) !!}
	</div>
	{!! Form::close() !!}
  </div>
  
  <div class="col-sm-6">
    {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id]]) !!}
    <div class="form-group">	  
	  {!! Form::submit('Delete Post', ['class'=>'btn btn-danger col-sm-6']) !!}
	</div>
    {!! Form::close() !!} 
  </div>

@stop


































