@extends('layouts.admin')

{{-- lekcija: 27 - Application - 192.Displaying users.mp4 --}}

@section('content')
  <h1>Users</h1>
  {{-- tabela koja prikazuje usere iz users tabele,podatke salje index() metod AdminUsersControllera --}}
  <table class="table">
    <thead>
      <tr>
	    <th>Id</th>
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
			<td>{{$user->name}}</td>
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






























