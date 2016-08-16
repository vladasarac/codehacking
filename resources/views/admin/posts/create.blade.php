@extends('layouts.admin')

{{-- lekcija: 28 - Application - Posts - 218.Setting route files.mp4, vju za kreiranje posta --}}
@section('content')

  <h1>Create Post</h1>
  
  {{--lekcija: 28 - Application - 222.Creating form part 1.mp4, forma za kreiranje posta--}}
  <div class="row">
  {!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files'=>true]) !!}
    <div class="form-group">
	  {!! Form::label('title', 'Title:') !!}
	  {!! Form::text('title', null, ['class'=>'form-control']) !!}
	</div>
	
	<div class="form-group">
	  {!! Form::label('category_id', 'Category:') !!}
	  {!! Form::select('category_id', array(1=>'PHP', 0=>'JavaScript'), null, ['class'=>'form-control']) !!}
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
	  {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
	</div>
  {!! Form::close() !!}
  </div> {{--kraj diva klase row--}}
  
  <div class="row">
    @include('includes.form_error')
  </div>
@stop






































