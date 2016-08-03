{{--ovaj fajl ce biti include-ovan u create.blade.php da prikaze errore ako ne prodje validacija u UsersRequest.php--}}
{{--lekcija: 27 - Application - 199.Displaying errors and including with blade.mp4, prikaz errora ako forma ne prodje validaciju u UsersRequest.php fajlu--}}
  @if(count($errors) > 0)  {{--ako ima nesto u $errors arrayu koji je globalan--}}
    <div class="alert alert-danger">
	  <ul>
	    @foreach($errors->all() as $error) {{--iteriraj kroz errors array i stampaj errore--}}
		  <li>{{$error}}</li>
		@endforeach
	  </ul>
	</div>
  @endif
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  