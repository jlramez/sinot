<?php

namespace App\Http\Controllers;

use App\user;
use App\roles;
use App\empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('admin')) {
            dd("El usuario es Admin");
        }else{
            dd("El usuario No es Admin"); 
        }
        $rsr=rol::all();
	    $rse=empleado::all();
		return view('admin.users.create', compact('rsr','rse'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        	//dd ($request->all());
		$rol_id=$request->rol_id;
		$empleado_id=$request->empleado_id;
		$last_id= DB::select('SELECT MAX(id) as ultimo FROM users');
		$id_usuario=($last_id[0]->ultimo) + 1 ;
		//dd($rol_id,$empleado_id);
		$validatedData= $request->validate([

			'name' => ['required', 'string',  'max:255', 'unique:users'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
		]);
		
	

		$user=new user();
		$user->name=$request->name;
		$user->email= $validatedData['email'];
		$user->email_verified_at=NULL;
		$user->password=Hash::make($validatedData['password']);
		$user->roles_id= $rol_id;
		$user->empleados_id= $empleado_id;
		$user->activo=1;
		$user->remember_token=NULL;
		$user->externo=0;
		$user->created_at=now();
		$user->updated_at=now();
		$user->save();

		$asigna_roles=new asigna_roles();
		$asigna_roles->users_id=$id_usuario;
		$asigna_roles->roles_id=$rol_id;
		$asigna_roles->activo=1;
		$asigna_roles->created_at=now();
		$asigna_roles->updated_at=now();
		$asigna_roles->save();

	
		
		
        $status="El registro se ha guardado correctamente";
		return back()->with(compact('status'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        return view ('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        $rsr=roles::all();
        return view('admin.users.edit', compact('user','rsr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
       //dd ($request->all());
		$activo=$request->activo;
		$rol_id=$request->roles_id;
		//dd($rol_id);
		$validatedData= $request->validate([

		'name' => 'required|min:7|max:255',
		'email' => 'required|min:2|max:255',
        'password' => 'required|min:8|max:255',

		]);
		
		$user->name= $validatedData['name'];
		$user->email= $validatedData['email'];
        $user->password=hash::make($validatedData['password']);
		$user->roles_id= $rol_id;
		$user->activo=1;
		$user->save();
		
        $status="El registro se ha actualizado correctamente";
		return back()->with(compact('status'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        $user->delete();

        return redirect('/users');


    }
}
