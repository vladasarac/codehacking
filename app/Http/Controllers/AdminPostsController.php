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
    public function edit($id){
       return view('admin.posts.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
      //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
      //
    }
	
}
























