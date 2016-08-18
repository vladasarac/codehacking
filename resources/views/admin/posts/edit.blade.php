@extends('layouts.admin')

{{-- lekcija: 28 - Application - 232.Editing part 1 - setting up the page and form.mp4, vju za editovanje posta --}}
@section('content')

  <h1>Edit Post</h1>
  
  <div class="row">
  
  <div class="col-sm-3">{{--div u kom je slika--}}
    {{--ako je user dodao sliku prikazi je ako nije prikazi sliku sa adrese 'http://placehold.it/400x400' koja prikazuje sivi kvadrat kao u index.blade.php --}}
    <img src="{{$post->photo ? $post->photo->file : 'http://placehold.it/400x400'}}" class="img-responsive img-rounded">   
  </div>
  
  <div class="col-sm-9">{{--div u kom je forma za editovanje podataka usera--}}
  {{--lekcija: 28 - Application - 222.Creating form part 1.mp4, forma za kreiranje posta--}}

  {!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminPostsController@update', $post->id], 'files'=>true]) !!}
    <div class="form-group">
	  {!! Form::label('title', 'Title:') !!}
	  {!! Form::text('title', null, ['class'=>'form-control']) !!}
	</div>
	
	<div class="form-group">
	  {!! Form::label('category_id', 'Category:') !!}
	     {{--lekcija: 28 - Application - 232.Editing part 1 - setting up the page and form.mp4--}}
	  {!! Form::select('category_id', $categories, null, ['class'=>'form-control']) !!} 
	</div>
	
	<div class="form-group">
	  {!! Form::label('photo_id', 'Photo:') !!}
	  {!! Form::file('photo_id', null, ['class'=>'form-control']) !!} {{--upload slike--}}
	</div>
	
	<div class="form-group">
	  {!! Form::label('body', 'Description:') !!}
	  {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
	</div>
	
	<div class="form-group">	  
	  {!! Form::submit('Update Post', ['class'=>'btn btn-primary col-sm-6']) !!}
	</div>
  {!! Form::close() !!}
  
  {{--lekcija: 28 - Application - 234.Deleting - Challlenge.mp4, forma tj samo btn za brisanje posta  --}}
  {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id]]) !!}
    <div class="form-group">	  
	  {!! Form::submit('Delete Post', ['class'=>'btn btn-danger col-sm-6']) !!}
	</div>
  {!! Form::close() !!}
  
  </div>  {{--kraj diva class="col-sm-9"--}}
  
  </div> {{--kraj diva klase row--}}
  
  <div class="row">
    @include('includes.form_error')
  </div>
@stop






































