<?php

namespace App\Http\Controllers;

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
	    $file->move('images', $name); // ubaci fajl u folder 'codehacking\public\images'
		$photo = Photo::create(['file'=>$name]); // u 'file' kolonu 'photos' tabele upisi ime fajla kji je uploadovan
        $input['photo_id'] = $photo->id; // u $input array u koji prebace $request upisi 'photo_id' da bude onaj koji je dodeljen fotografiji u tabeli 'photos'		
	  }
	  $input['password'] = bcrypt($request->password); // kriptuj password koji je user uneo u formu i ubaci ga u input array da bude upisan u bazu
	  User::create($input); // upisi red u tabelu users koristeci $input array u koji je ubacen $request array
	  
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
      // prepravljanje , lekcija: 27 - Application - 211.Updating part 3 - Fixing loose ends.mp4
	  if(trim($request->password) == ''){ // ako nista nije uneto u password input u formi
	    $input = $request->except('password'); // u input array ubaci sve osim passworda
	  }else{ // ako je unet password uzmi sve sto je stiglo u requestu u $input array
	    $input = $request->all(); // ubaci sve iz requesta u varijablu
	  }
	  
	  $user = User::findOrFail($id); // nadji u bazi usera po id koji je stigao kad je pozvan metod pored requesta
	  $input = $request->all(); // uzmi sta je user uneo u formu u edit.blade.php
	  if($file = $request->file('photo_id')){ // ako je user uneo novu sliku tj popunjen je photo_id input u formi
	    $name = time() . $file->getClientOriginalName(); // napravi ime za uploadovani fajl tj sliku tako sto na trenutno vreme konkatenujes originalno ime slike
		$file->move('images', $name); // ubaci fajl u folder 'codehacking\public\images'
		$photo = Photo::create(['file'=>$name]); // u 'file' kolonu 'photos' tabele upisi ime fajla kji je uploadovan
		$input['photo_id'] = $photo->id; // u $input array u koji prebace $request upisi 'photo_id' da bude onaj koji je dodeljen fotografiji u tabeli 'photos'		
	  }
	  $input['password'] = bcrypt($request->password); // kriptuj password koji je user uneo u formu i ubaci ga u input array da bude upisan u bazu
	  $user->update($input); // updateuj usera u users tabeli koristeci $input array
	  return redirect('/admin/users');
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

























