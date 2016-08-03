@extends('layouts.admin')

{{--lekcija: 27 - Application - 193.Create page.mp4 , ovaj vju poziva create() metod AdminUsersController-a a URL tj ruta je http://codehacking.dev/admin/users/create --}}

@section('content')

  <h1>Create Users</h1>
  {{-- ovde se koristi laravelCollective/html paket koji smo sada ubacili u aplikaciju koji pomaze pri pravljenju formi --}}
  {{--salje podatke store() metodu AdminUsersController-a forma je i za upload slike novog usera tako da je 'files'=>true (lekcija: 27 - Application - 200.Adding upload file feature to form.mp4)--}}
  {!! Form::open(['method'=>'POST', 'action'=>'AdminUsersController@store', 'files' => true ]) !!} 
  
	<div class="form-group">
	  {!! Form::label('name', 'Name:') !!}
	  {!! Form::text('name', null, ['class'=>'form-control']) !!} {{-- ime novog usera --}}
	</div>
	
	<div class="form-group">
	  {!! Form::label('email', 'Email:') !!}
	  {!! Form::email('email', null, ['class'=>'form-control']) !!} {{-- email novog usera --}}
	</div>
	
	<div class="form-group">
	  {!! Form::label('role_id', 'Role:') !!}
	  {!! Form::select('role_id', [''=>'Chose Options'] + $roles, null, ['class'=>'form-control']) !!} {{--ovo ce biti input select koji ce biti popunjen imenima rola iz 'roles' tabele, rola novog usera --}}
	</div>
	
	<div class="form-group">
	  {!! Form::label('is_active', 'Status:') !!}
	  {!! Form::select('is_active', array(1 => 'Active', 0 => 'Not Active'), 0, ['class'=>'form-control']) !!} {{-- polje je input select i moze se birati izmedju Active(salje 1 u kontorler) i Not Active(salje 0 u kontroler) po difoltu je Not Active tj 0, status novog usera, tj da li je aktivan ili nije(is_Active kolona users tabele) --}}
	</div>
	
	{{--dodavanje polja za unos slike ,  lekcija: 27 - Application - 200.Adding upload file feature to form.mp4--}}
	<div class="form-group">
	  {!! Form::label('photo_id', 'Photo:') !!}
	  {!! Form::file('photo_id', null, ['class'=>'form-control']) !!} {{--dodavanje slike--}}
	</div>
	
	{{-- lekcija: 27 - Application - 198.Password field and custom request.mp4 --}}
	<div class="form-group">
	  {!! Form::label('password', 'Password:') !!}
	  {!! Form::password('password', ['class'=>'form-control']) !!} {{-- password polje --}}
	</div>
	
	
	<div class="form-group">
	  {!! Form::submit('Create User', ['class'=>'btn btn-primary']) !!}
	</div>
	
  {!! Form::close() !!}
  
  {{--lekcija: 27 - Application - 199.Displaying errors and including with blade.mp4, inkluduj form_error.blade.php koji stampa errore ako ih ima pri validaciji forme koja se radi u UsersRequest.php--}}
  @include('includes.form_error')
  
@stop




































