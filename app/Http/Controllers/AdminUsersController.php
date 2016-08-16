<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;
use App\Photo;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Requests;

class AdminUsersController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	// URL : http://codehacking.dev/admin/users poziva index.blade.php iz foldera 'codehacking\resources\views\admin\users'
    public function index(){
      // lekcija: 27 - Application - 187.Testing methods.mp4
	  $users = User::all(); // izvadi sve iz 'users' tabele(preko User modela)
	  return view('admin.users.index', compact('users')); // pozovi vju index.blade.php iz foldera 'codehacking\resources\views\admin\users' i posalji mu usere izvucene iz tabele 'users'
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	// lekcija: 27 - Application - 194.Laravel collective html package.mp4
	// URL : http://codehacking.dev/admin/users/create poziva create.blade.php iz foldera 'codehacking\resources\views\admin\users'
    public function create(){
      // lekcija: 27 - Application - 187.Testing methods.mp4
	  // lekcija: 27 - Application - 197.Populating the user roles select.mp4, izvlacenje rola iz 'roles' tabele da bi se popunio select field za biranje role kad se kreira novi user ucreate.blade.php iz foldera 'codehacking\resources\views\admin\users'
	  $roles = Role::lists('name', 'id')->all(); // izvuci imena i id-eve rola iz roles tabele
	  return view('admin.users.create', compact('roles')); // pozovi vju i posalji mu imena i id-eve rola iz roles tabele
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	// lekcija: 27 - Application - 195.Testing form and creating form fields.mp4
	// metod prima unos u formu u vjuu create.blade.php iz foldera 'codehacking\resources\views\admin\users' koja sluzi za kreiranje novog usera
    public function store(UsersRequest $request){
	  // prepravljanje , lekcija: 27 - Application - 211.Updating part 3 - Fixing loose ends.mp4
	  if(trim($request->password) == ''){ // ako nista nije uneto u password input u formi
	    $input = $request->except('password'); // u input array ubaci sve osim passworda
	  }else{ // ako je unet password uzmi sve sto je stiglo u requestu u $input array
	    $input = $request->all(); // ubaci sve iz requesta u varijablu
	  }
	   
	  //User::create($request->all());  // napravi usera u users tabeli i upisi sta je stiglo u requestu posto se imena kolona podudaraju sa imenima polja u formi    
	  if($file = $request->file('photo_id')){ // proveri da li je uploadovana fotografija pri kreiranju novog usera u formi u create.blade.php iz foldera 'codehacking\resources\views\admin\users'
	    // ako jeste radi ovo -
		$name = time().$file->getClientOriginalName();// napravi ime za uploadovani fajl tj sliku tako sto na trenutno vreme konkatenujes originalno ime slike
	    //return $name;
		$file->move('images', $name); // ubaci fajl u folder 'codehacking\public\images'
		$photo = Photo::create(['file'=>$name]); // u 'file' kolonu 'photos' tabele upisi ime fajla kji je uploadovan
        $input['photo_id'] = $photo->id; // u $input array u koji prebace $request upisi 'photo_id' da bude onaj koji je dodeljen fotografiji u tabeli 'photos'		
	  }
	  $input['password'] = bcrypt($request->password); // kriptuj password koji je user uneo u formu i ubaci ga u input array da bude upisan u bazu
	  User::create($input); // upisi red u tabelu users koristeci $input array u koji je ubacen $request array
	  Session::flash('created_user', 'The user '.$input['name'].' has been created'); // upisi u sesiju poruku da je user napravljen
	  return redirect('/admin/users');   // redirectuj na index.blade.php iz foldera 'resources\views\admin\users' koji prikazuje tabelu sa userima iz baze
	  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
      // lekcija: 27 - Application - 187.Testing methods.mp4
	  return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 
	// lekcija: 27 - Application - 207.Edit users part 1 - setting up the form.mp4
    public function edit($id){
      $user = User::findOrFail($id); // nadji usera u 'users' tabeli po id
	  $roles = Role::lists('name', 'id')->all(); // iz 'roles' tabele izvuci role posto ih treba prikazati u edit.blade.php u dropdown-u
	  return view('admin.users.edit', compact('user', 'roles')); // i posalji usera i role u vju edit.blade.php iz foldera 'codehacking\resources\views\admin\users' u kom je forma za editovanje usera
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 
	// lekcija: 27 - Application - 209.Updating part 1 and displaying errors.mp4, metod za update postojeceg usera, stize mu request iz
	// - edit.blade.php u kom je forma popunjena podatcima usera koji su stigli iz metoda edit($id) i validacija je uradjena u UsersRequest.php, takodje mu stize i $id usera posto je tako napisano pri otvaranju forme
    public function update(UsersEditRequest $request, $id){ // koristi se UsersEditRequest da bi radio validaciju koja je u metodu rules() u UsersEditRequest.php
      $input = $request->all(); // uzmi sta je user uneo u formu u edit.blade.php
	  // prepravljanje , lekcija: 27 - Application - 211.Updating part 3 - Fixing loose ends.mp4
	  if($request->get('password') == ''){ // ako nista nije uneto u password input u formi
	    $input = $request->except('password'); // u input array ubaci sve osim passworda
	  }else{ // ako je unet password uzmi sve sto je stiglo u requestu u $input array
	    $input = $request->all(); // ubaci sve iz requesta u varijablu
		$input['password'] = bcrypt($request->password); // kriptuj password koji je user uneo u formu i ubaci ga u input array da bude upisan u bazu
	  }
	  $user = User::findOrFail($id); // nadji u bazi usera po id koji je stigao kad je pozvan metod pored requesta
	  //$input = $request->all(); // uzmi sta je user uneo u formu u edit.blade.php
	  if($file = $request->file('photo_id')){ // ako je user uneo novu sliku tj popunjen je photo_id input u formi
	    $name = time() . $file->getClientOriginalName(); // napravi ime za uploadovani fajl tj sliku tako sto na trenutno vreme konkatenujes originalno ime slike
		$file->move('images', $name); // ubaci fajl u folder 'codehacking\public\images'
		$photo = Photo::create(['file'=>$name]); // u 'file' kolonu 'photos' tabele upisi ime fajla kji je uploadovan
		$input['photo_id'] = $photo->id; // u $input array u koji prebace $request upisi 'photo_id' da bude onaj koji je dodeljen fotografiji u tabeli 'photos'		
	  }
	  //$input['password'] = bcrypt($request->password); // kriptuj password koji je user uneo u formu i ubaci ga u input array da bude upisan u bazu
	  $user->update($input); // updateuj usera u users tabeli koristeci $input array
	  Session::flash('updated_user', 'The user '.$input['name'].' has been updated'); // upisi u sesiju poruku da je prepravljen user da bi je index.blade.php prikazao
	  return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 
	// lekcija: 27 - Application - 214.Deleting users.mp4
    public function destroy($id){
	  //User::findOrFail($id)->delete();
	  // lekcija: 27 - Application - 216.Deleting images from the directory.mp4, prepravka da brise sliku usera iz foldera 'codehacking\public\images'
	  $user = User::findOrFail($id);
	  unlink(public_path() . $user->photo->file); // prvo obrisi sliku(ime slike uzmi iz 'photos' tabele i konkateniraj ga na folder u kom su slike 'codehacking\public\images')
	  
	  // ja dodo da brise i iz 'photos' tabele sliku tj putanju ka slici substr se radi posto u Photo.php modelu ima metod getFileAttribute($photo) koji na ime slike tj 'file' kolonu dodaje string '/images/' da bi u vjuu bilo lakse da se izvuce skia pa sada ovde to odsecamo da bi nasli sliku po 'file' koloni
	  $imeslike = substr($user->photo->file, 8);
	  $brisisliku = Photo::where('file', $imeslike)->delete(); // dovde
	  
	  $user->delete(); // obrisi red u users tabeli  
	  Session::flash('deleted_user', 'The user has been deleted'); // upisi u sesiju da je user obrisan pod kljucem 'deleted_user'
	  return redirect('/admin/users');
	  
    }
}

























