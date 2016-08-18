@extends('layouts.admin')

@section('content')
  
  {{--lekcija: 29 - Application - Categories - 239.Creating categories.mp4--}}
  <h1>Categories</h1>
  
  {{--u ovom divu je forma za kreiranje nove kategorije koja ce slati POST store() metodu AdminCategoriesController-a--}}
  <div class="col-sm-6">
    {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}
	  <div class="form-group">
	  {!! Form::label('name', 'Name:') !!}
	  {!! Form::text('name', null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">	  
	  {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
	</div>
	{!! Form::close() !!}
  </div>
  
  {{--u ovom divu je tabela sa kategorijama koje je iz tabele 'categories' izvukao index() metod AdminCategoriesController-a--}}
  <div class="col-sm-6">
  @if($categories) {{--ako iz AdminCategoriesController-a tj njegovog index() metoda stignu neke kategorije prikazi ih u tabeli--}}
    <table class="table">
	  <thead>
	    <th>id</th>
		<th>Name</th>
		<th>Created date</th>
	  </thead>
	  <tbody>
	  @foreach($categories as $category)
	   <tr>
	    <td>{{$category->id}}</td>
		<td>{{$category->name}}</td>
		{{--diffForHumans() je carbon metod tako da ce datum prikazati u formatu npr '2 days ago' ,  ako ima created_at kolonu prikazi je ako nije popunjena tj NULL je prikazi 'no date'--}}
		<td>{{$category->created_at ? $category->created_at->diffForHumans() : 'no date'}}</td>
	   </tr>	
	  @endforeach	
	  </tbody>
	</table>
  @endif
  </div>

@stop


































