@extends('layouts.admin')

{{-- lekcija: 27 - Application - 192.Displaying users.mp4 --}}

@section('content')

  @if(Session::has('deleted_user')) {{--kad se obrise user u destroy() metodu AdminUsersControllera u sesiju pod kljucem 'deleted_user' se upisuje 'The user has been deleted', ako postoji to u sesiji prikazi--}}
    <p class="bg-danger">{{session('deleted_user')}}</p>
  @endif
  
  @if(Session::has('updated_user')) {{--kad se updateuje user u update() metodu AdminUsersControllera u sesiju pod kljucem 'updated_user' se upisuje 'The user has been updated', ako postoji to u sesiji prikazi--}}
    <p class="bg-info">{{session('updated_user')}}</p>
  @endif
  
  @if(Session::has('created_user')) {{--kad se kreira user u store() metodu AdminUsersControllera u sesiju pod kljucem 'created_user' se upisuje 'The user has been created', ako postoji to u sesiji prikazi--}}
    <p class="bg-success">{{session('created_user')}}</p>
  @endif
  <h1>Users</h1>
  {{-- tabela koja prikazuje usere iz users tabele,podatke salje index() metod AdminUsersControllera --}}
  <table class="table">
    <thead>
      <tr>
	    <th>Id</th>
		<th>Photo</th> {{--lekcija: 27 - Application - 206.Displaying photos using an accessor.mp4, dodaj u tabelu i sliku koju je user uploadovao kad je pravio profil--}}
	    <th>Name</th>
	    <th>Email</th>
		<th>Role</th>
		<th>Status</th>
		<th>Created</th>
		<th>Updated</th>
	  </tr>
	</thead>
	<tbody> 
	  {{--ako iz index() metoda AdminUsersControllera stignu neki podatci(on izvlaci sve usere iz users tabele), prikazi ih u tabeli --}}
	  @if($users)
	    @foreach($users as $user) {{-- iteriraj kroz objekat koji je stigao iz kontrolera --}}
		  <tr>  {{--i prikazi id, ime, email, datum kreiranja i datum update-ovanja usera u tabeli--}}
		    <td>{{$user->id}}</td>
			{{--prikazi sliku usera(u koloni 'file' u tabeli 'photos' se nalazi putanja tj ime fajla (slike usera) koja je u folderu 'codehacking\public\images' )--}}
			{{--ako user ima sliku prikazi je ako je nema prikazi nopic.jpg iz foldera 'codehacking\public\images' koju sam ubacio tamo i prikazuje samo siluetu --}}
			<td><img src="{{$user->photo ? $user->photo->file : '/images/nopic.jpg'}}" class="img-responsive img-rounded"></td> 
			{{--ovo je sada link koji poziva edit()(ruta 'admin.users.edit' i salje se id usera u metod) metod AdminUsersControllera koji vadi usera po id iz tabele i salje ga u vju edit.blade.php na editovanje, lekcija: 27 - Application - 207.Edit users part 1 - setting up the form.mp4--}}
			<td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</a></td>
			<td>{{$user->email}}</td>
			<td>{{$user->role->name}}</td> {{-- posto su Role i User modeli povezani tj. User belongsTo Role ovako se izvlaci ime role iz 'roles' tabele preko id-a role u 'users' tabeli koja je foreuign key izvucen iz 'roles' tabele --}}
			<td>{{$user->is_active == 1 ? 'Active' : 'Not Active'}}</td> {{-- ako je kolona is_active 1 onda je user aktivan i napisi 'Active' u tabeli ako nije 1 (onda je 0) znaci da nije aktivan i napisi 'Not Active' --}}
			<td>{{$user->created_at->diffForHumans()}}</td> {{--diffForHumans() je carbon metod tako da ce datum prikazati u formatu npr '2 days ago'--}}
			<td>{{$user->updated_at->diffForHumans()}}</td>
		  </tr>
		@endforeach
	  @endif
	</tbody>
  </table>
@stop






























