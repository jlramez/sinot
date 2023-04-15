<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\roles;
use App\empleado;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {

    	$this->middleware('auth');

    }
	public function index()
	{
		$usuarios=user::with('roles')->paginate(10);
		//dd($usuarios);		
		return view('usuarios.admin', compact('usuarios'));

	}


	public function show(user $user)
	{
		
		return view('usuarios.show', compact('user'));


	}

	
	public function create()
	{
		$rsr=roles::all();
	    $rse=empleado::all();
		return view('usuarios.create', compact('rsr','rse'));

	}
	public function create_externo()
	{
		
		return view('usuarios.create_externo');

	}



	public function store(Request $request)
	{
			
			
		//dd ($request->all());
		$rol_id=$request->rol_id;
		$empleado_id=$request->empleado_id;
		//dd($rol_id,$empleado_id,'name');
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
		
        $status="El registro se ha guardado correctamente";
		return back()->with(compact('status'));
	}
	public function edit(user $user)
	{

		$rsr=roles::all();
		return view('usuarios.edit', compact('user','rsr'));

	}

	public function store_externo(Request $request)
	{
			
			
		dd ($request->all());
		$rol_id=$request->rol_id;
		$empleado_id=$request->empleado_id;
		//dd($rol_id,$empleado_id,'name');
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
		$user->roles_id= 11;
		$user->empleados_id= 60;
		$user->activo=1;
		$user->remember_token=NULL;
		$user->externo=1;
		$user->expedientes_id=$request->expedientes_id;
		$user->created_at=now();
		$user->updated_at=now();
		$user->save();
		
        $status="El registro se ha guardado correctamente";
		return back()->with(compact('status'));
	}

	public function status(user $usuario)
	{
		//$usuarios=user::all();
		//dd($user->id);
		return view('usuarios.status', compact('usuario'));

	}

   public function modify_status(user $usuario)
   {

		$activo=$usuario->activo;
		//dd($activo);
		if($activo==1)
		{
			$activo=0;
		//dd($activo);
			$usuario->activo=$activo;
			$usuario->save();
			$como='desactivado';	
			//dd($activo);
		}	
		elseif($activo==0)
		{
			$activo=1;
			//dd($activo);
			$usuario->activo=$activo;
			$usuario->save();
			$como='activado';		
			//dd($activo);
		}
$status="El registro se ha ". $como ." correctamente";
return back()->with(compact('status'));



   }
	public function update(Request $request, user $user)
	{
			
		//dd ($request->all());
		$activo=$request->activo;
		$rol_id=$request->roles_id;
		//dd($rol_id);
		$validatedData= $request->validate([

		'name' => 'required|min:7|max:255',
		'email' => 'required|min:2|max:255',

		]);
		
		$user->name= $validatedData['name'];
		$user->email= $validatedData['email'];
		$user->roles_id= $rol_id;
		$user->activo=1;
		$user->save();
		
        $status="El registro se ha actualizado correctamente";
		return back()->with(compact('status'));
		
	}

	public function destroy(Request $request, user $user)
	{
	
        //dd ($request->all());
		//$area->$area::find($id);
		$user->delete();
		//Flash::warning('El área ha sido eliminada');
		//return redirect()->route('admin_area');

	    /*$this->emit('sweet-alert', 'la información se borro correctamente');
        $this->resetPage();*/
		$status="El registro se ha eliminado correctamente";
		//return back()->with(compact('status'));
		return redirect()->route('admin_user');


	}
}
