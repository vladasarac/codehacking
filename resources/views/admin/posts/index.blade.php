@extends('layouts.admin')

{{-- lekcija: 28 - Application - Posts - 218.Setting route files.mp4, vju prikazuje sve postove --}}
@section('content')
  <h1>Posts</h1>
  
  {{--lekcija: 28 - Application - 220.Displaying post.mp4, tabela koja prikazuje postove koji je index() metod AdminPostsControllera izvukao iz 'posts' tabele--}}
  <table class="table">
    <thead>
	  <tr>
	    <th>Id</th>
		<th>Photo</th>
		<th>Owner</th>
		<th>Category</th>
		<th>Title</th>
		<th>Body</th>
		<th>Created</th>
		<th>Updated</th>
	  </tr> 
	</thead>
	<tbody>
	  @if($posts)
	    @foreach($posts as $post)
	      <tr>
	        <td>{{$post->id}}</td>
			    {{-- ako post ima dodatu sliku prikazi je (kad se vadi 'file' kolona iz photos tabele u Photo.php modelu je podeseno da konkatenira na taj string '/images/' tako da se odmah 
			     moze ubaciti u href attr kao putanja), ako nema slike prikazi sliku sa urla-http://placehold.it/400x400 koji prikazuje samo sivi kvadrat --}}
			<td><img height="70" src="{{$post->photo ? $post->photo->file : 'http://placehold.it/400x400'}}" alt=""></td> {{-- lekcija: 28 - Application - 227.Displaying images in post.mp4 --}}
		    <td>{{$post->user->name}}</td>
			{{--ako post ima kategoriju izvuciime kategorije iz 'categories' tabele ako nema napisi 'Uncategorized'--}}
			<td>{{$post->category ? $post->category->name : 'Uncategorized'}}</td> {{--lekcija: 28 - Application - 229.Displaying and creating posts with categories.mp4--}}
			<td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->title}}</a></td>
			<td>{{str_limit($post->body, 30)}}</td> {{-- str_limit() skracuje string na onoliko karaktera koliko mu napisemo u ovom slucaju 30 --}}
			<td>{{$post->created_at->diffForHumans()}}</td>  {{--diffForHumans() je carbon metod tako da ce datum prikazati u formatu npr '2 days ago'--}}
			<td>{{$post->updated_at->diffForHumans()}}</td>
	      </tr> 
		@endforeach
	  @endif
	</tbody>
  </table>
  
@stop


































