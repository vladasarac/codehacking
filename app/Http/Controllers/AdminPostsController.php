<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostsCreateRequest;
use App\Post;
use App\Photo;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller{

// lekcija: 28 - Application - Posts - 218.Setting route files.mp4, kontroler za postove
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
	  // lekcija: 28 - Application - 220.Displaying post.mp4, izvuci sve postove i posalji ih u index.blade.php iz foldera 'codehacking\resources\views\admin\posts' koji ce ih prikazati
      $posts = Post::all();
	  return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
	  // lekcija: 28 - Application - 229.Displaying and creating posts with categories.mp4, dodavanje kategorije pri kreiranju novog posta
	  $categories = Category::lists('name', 'id')->all(); // izvuci iz 'categories' tabele kolone name i id i ubaci u $categories varijablu koja ce biti poslata u creater.blade.php gde ce kategorie biti prikazane u selectu da bi user odabrao kategoriju posta
      return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	 
    // lekcija: 28 - Application - 223.Creating form part 2.mp4
    public function store(PostsCreateRequest $request){
      $input = $request->all();
	  $user = Auth::user(); // usera koji je trenutno ulogovan ubaci u varijablu da bi mogao da se popuni user_id u posts tabeli
	  if($file = $request->file('photo_id')){ // proveri da li je user uploadovao sliku , ako jeste upisi je u bazu i uploaduj u folder 'public/images'
	    $name = time() . $file->getClientOriginalName(); // uzmi originalno ime slike i na njega dodaj trenutno vreme da bi slika imala jedinstveno ime
        //return $name;	
        $file->move('images', $name); // uploaduj sliku u folder 'codehacking\public\images'
        $photo = Photo::create(['file'=>$name]); // upisi red u 'photos' tabelu tj u njenu kolonu 'file' (to je ime slike) 
        $input['photo_id'] = $photo->id; // id upravo uploadovane slike iz 'photos' tabele ce biti upisan u 'photo_id' kolonu u 'posts' tabeli		
	  }
	  $user->posts()->create($input); // upisi red u 'posts' tabelu koristeci $input u koji je ubacen ceo request iz create.blade.php posto se name-ovi inputa iz forme podudaraju sa imenima kolona u 'posts' tabeli 
	  return redirect('/admin/posts'); // redirectuj na index.blade.php koji prikazuje sve postove
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
      //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 
	// lekcija: 28 - Application - 232.Editing part 1 - setting up the page and form.mp4
	// ruta je 'admin.post.edit' i daje se id posta pored imena rute, a URL je http://codehacking.dev/admin/posts/8/edit (ako je post za editovanje sa id 8) 
    public function edit($id){
	  $post = Post::findOrFail($id); // nadji post ciji je id stigao kad je pozvan metod
	  $categories = Category::lists('name', 'id')->all(); // izvuci sve id-eve i imena kategorija posto ce biti selekt za kategoriju ako user zeli da je promeni 
      return view('admin.posts.edit', compact('post', 'categories')); // salji ga u vju edit.blade.php iz foldera 'codehacking\resources\views\admin\posts' da bude prikazan u formi i da se edituje 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	
	// lekcija: 28 - Application - 233.Editing part 2 - Lets edit the post.mp4
    public function update(Request $request, $id){
	  $input = $request->all();
      if($file = $request->file('photo_id')){ // proveri da li je user uploadovao sliku , ako jeste upisi je u bazu i uploaduj u folder 'public/images'
	    $name = time() . $file->getClientOriginalName(); // uzmi originalno ime slike i na njega dodaj trenutno vreme da bi slika imala jedinstveno ime 
        $file->move('images', $name); // uploaduj sliku u folder 'codehacking\public\images'
        $photo = Photo::create(['file'=>$name]); // upisi red u 'photos' tabelu tj u njenu kolonu 'file' (to je ime slike) 
        $input['photo_id'] = $photo->id; // id upravo uploadovane slike iz 'photos' tabele ce biti upisan u 'photo_id' kolonu u 'posts' tabeli		
	  }
	  Auth::user()->posts()->whereId($id)->first()->update($input);
	  return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 
	// lekcija: 28 - Application - 234.Deleting - 235.Deleting - Solution.mp4
    public function destroy($id){
      //return "Stigao post sa id: ".$id;
	  $post = Post::findOrFail($id);
	  unlink(public_path() . $post->photo->file);
	  // ja dodo da brise i iz 'photos' tabele sliku tj putanju ka slici substr se radi posto u Photo.php modelu ima metod getFileAttribute($photo) koji na ime slike tj 'file' kolonu dodaje string '/images/' da bi u vjuu bilo lakse da se izvuce skia pa sada ovde to odsecamo da bi nasli sliku po 'file' koloni
	  $imeslike = substr($post->photo->file, 8);
	  $brisisliku = Photo::where('file', $imeslike)->delete(); // dovde
	  $post->delete();
	  return redirect('/admin/posts'); 
    }
	
}
























