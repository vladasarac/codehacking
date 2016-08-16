@extends('layouts.admin')

{{--lekcija: 27 - Application - 207.Edit users part 1 - setting up the form.mp4, forma prekopirana iz create.blade.php istog foldera kao i ovaj fajl samo malo izmenjena
     - posto je ovo forma za editovanje vec postojeceg usera --}}

@section('content')
  <?php
  // ja dodao samo sam nesto isprobavao
  /* echo '<pre>';
  print_r($user);
  echo '</pre>';
  
  echo '<pre>';
  print_r($user->role);
  echo '</pre>'; */
  // preko $user modela moze se pristupiti i photos i roles tabeli i njihovim kolonama
  // echo '<h3>'.$user->role->name.'<h3>';
  // echo '<h3>'.$user->photo->file.'</h3>';
  ?>
  <h1>Edit User</h1>
  
  <div class="row">
  
  {{-- lekcija: 27 - Application - 208.Edit user part 2 - displaying images and status.mp4 --}}
  <div class="col-sm-3">{{--div u kom je userova slika--}}
    {{--ako je user dodao sliku prikazi je ako nije prikazi nopic.jpg sliku koju sam ubacio u folder 'codehacking\public\images' koja prikazuje siluetu portreta --}}
    <img src="{{$user->photo ? $user->photo->file : '/images/nopic.jpg'}}" class="img-responsive img-rounded">   
  </div>
  
  <div class="col-sm-9">{{--div u kom je forma za editovanje podataka usera--}}
    
	{{-- ovde se koristi laravelCollective/html paket koji smo sada ubacili u aplikaciju koji pomaze pri pravljenju formi --}}
    {{--koristi se metod Form::model() kom se kao prvi parametar ubacuje $user koji je stigao iz edit() metoda AdminUsersController-a tako da ce polja biti popunjena njegovim- 
        - podatcima iz baze posto se imena kolona podudaraju sa imenima polja u formi takodje metod forme je PATCH (to je neko laravelovo sranje) --}}
	  
    {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files' => true ]) !!} 
  
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
	    {!! Form::select('role_id', $roles, null, ['class'=>'form-control']) !!} {{--ovo ce biti input select koji ce biti popunjen imenima rola iz 'roles' tabele, rola usera --}}
      </div>
	
	  <div class="form-group">
	    {!! Form::label('is_active', 'Status:') !!}
	    {!! Form::select('is_active', array(1 => 'Active', 0 => 'Not Active'), null, ['class'=>'form-control']) !!} {{-- polje je input select i moze se birati izmedju Active(salje 1 u kontorler) i Not Active(salje 0 u kontroler) --}}
	  </div>
	
	  <div class="form-group">
	    {!! Form::label('photo_id', 'Photo:') !!}
	    {!! Form::file('photo_id', null, ['class'=>'form-control']) !!} {{--dodavanje slike--}}
	  </div>
	
	  <div class="form-group">
	    {!! Form::label('password', 'Password:') !!}
	    {!! Form::password('password', ['class'=>'form-control']) !!} {{-- password polje --}}
	  </div>
	
	
	  <div class="form-group">
  	    {!! Form::submit('Update User', ['class'=>'btn btn-primary col-sm-6']) !!}
	  </div>
	
    {!! Form::close() !!}
	
	
	{{--lekcija: 27 - Application - 214.Deleting users.mp4, forma za brisanje usera, poziva destroy() metod AdminUsersController-a--}}
	{!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id]]) !!} {{--daje se parametar userov id posto DELETE metod to zahteva posto mora stici userov id u destroy metod--}}
	  <div class="form-group">
	    {!! Form::submit('Delete User', ['class'=>'btn btn-danger col-sm-6']) !!}
	  </div>
	{!! Form::close() !!}
	
  </div>  {{--kraj diva class="col-sm-3"--}}
  
  </div> {{--kraj diva class="row"--}}
  
  <div class="row">
  
    {{-- inkluduj form_error.blade.php koji stampa errore ako ih ima pri validaciji forme koja se radi u UsersRequest.php--}}
    @include('includes.form_error')
	
  </div>
@stop




































