<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\user;
use App\roles;
use App\empleado;
use App\expediente;
use App\buzones;
use App\asigna_roles;
use App\asigna_expedientes;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class TrijezUserController extends Controller
{
	public function __construct()
    {

    	$this->middleware('auth');

    }
	public function index()
	{
		$usuarios=user::with('roles')->paginate(10);
		foreach($usuarios as $uausrio)
			{
				$usuarios_select=user::with('roles')->get();
			}	
				$ae=user::with('asigna_expedientes')->get();
		//dd($ae);
			
		return view('usuarios.admin', compact('usuarios','ae'));

	}
	public function firmantes()
	{
		$empleados=empleado::with('puestos')->paginate(10);
		
		//dd($ae);
			
		return view('usuarios.firmantes', compact('empleados'));

	}


	public function show(user $user)
	{
		
		$usuario=user::with('roles')->where('id',$user->id)->first();
		return view('usuarios.show', compact('usuario'));


	}

	
	public function create()
	{

		/*if (Gate::allows('admin'))
	   {
            dd("El usuario es Admin");
        }
		else
		{
            dd("El usuario No es Admin"); 
        }*/
        $rsr=roles::all();
	    $rse=empleado::all();
		return view('usuarios.create', compact('rsr','rse'));
    }

	public function create_externo()
	{
		
		$rs_expediente=expediente::all();
		return view('usuarios.create_externo', compact('rs_expediente'));

	}

	public function create_externo_expediente(expediente $expediente)
	{
		
		$name=$expediente->actor;	
		$user_01= substr ( $name , 0 , 1 );
		$user_02= explode(" ", $name);
		$user=strtolower (($user_01.$user_02[1].'@trijez.mx'));
		$user_03= rand ( 1 , 999 );
		//$user_full=strtolower (($user_01.$user_02[1].$user_03.'@trijez.mx'));
		//dd($user);
		//$existe_usuario=DB::select('SELECT COUNT(*) as cuantos FROM users WHERE CURP="'.$curp.'"');
		$existe_email = DB::select('SELECT COUNT(*) as cuantos FROM users WHERE email='.'"'.$user.'"');
	
		//dd($existe_email[0]->cuantos);
		//Carácteres para la contraseña
		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$password = "";
		//Reconstruimos la contraseña segun la longitud que se quiera
		for($i=0;$i<8;$i++) 
		{
		   //obtenemos un caracter aleatorio escogido de la cadena de caracteres
		   $password .= substr($str,rand(0,62),1);
		}
		//Mostramos la contraseña generada
		//dd('Password generado: '.$password. ' Usario:'.$user_full);
	 


//$rs_expediente=expediente::all();

		if ($existe_email[0]->cuantos==1)
			{
				$curprs=user::with('expedientes')->where('email',$user)->get();
				//dd($curprs);
				$curp=$curprs[0]->CURP;
				$user_id=$curprs[0]->id;
				$user_full=strtolower (($user_01.$user_02[1].$user_03.'@trijez.mx'));
			    //dd('YA existe el usuario',$user,'el coreo asignado será:', $user_full, 'con el id:' ,$user_id);
				
				$nuevo=$expediente->nuevo;
				if ($nuevo==1)
				{
				
				return view('usuarios.create_externo_expediente', compact('expediente','user_full','password','curp','user_id'));
				}
				else
				{
				//dd("aqui toma el valor view");
				$view=0;
				return view('usuarios.create_terceros', compact('expediente','user_full','password','user_id','view'));
				}
				
			}
		  else
		  	{				
				$curprs=user::with('expedientes')->where('email',$user)->get();
				//dd("AQUI".$curprs);
				/*if($curprs) //aqui voy 
				{
					//dd("aqui voy");
					$status="No existe información , favor de capturarla.  ";
					$type="alert alert-danger";				
					return back()->with(compact('status','type'));
				}
				$curp=$curprs[0]->CURP;
				$user_id=$curprs[0]->id;*/	
				$user_full=strtolower (($user_01.$user_02[1].'@trijez.mx'));
				//dd('NO existe el usuario',$user_full);
				$nuevo=$expediente->nuevo;
				if ($nuevo)
				{
				$curp=NULL;	
				//dd($user_full,$expediente,$password,$curp);
				return view('usuarios.create_externo_expediente', compact('expediente','user_full','password','curp'));
				}
				else
				{
				//dd('aqui es el prolema');
				return view('usuarios.create_terceros', compact('expediente','user_full','password'));
				}

		  	}
			
		

	}



	

	public function store(Request $request, asigna_roles $asigna_roles)
	{
			
			
		//dd ($request->all());
		$rol_id=$request->rol_id;
		$empleado_id=$request->empleado_id;
		$curp=empleado::with('puestos')->where('id',$empleado_id)->get();
		//dd($curp[0]->curp);
		$last_id_user= DB::select('SELECT AUTO_INCREMENT as last_id
		FROM  INFORMATION_SCHEMA.TABLES
		WHERE TABLE_SCHEMA = "trijez"
		AND   TABLE_NAME   = "users"');
		$last_id_usuario=($last_id_user[0]->last_id);
		$last_id_usuario_roles=($last_id_user[0]->last_id);
		$last_id= DB::select('SELECT MAX(id) as ultimo FROM users');
		//$id_usuario=($last_id[0]->ultimo) + 1 ;//ERROR!!!!!
		//dd($rol_id,$empleado_id,$last_id_usuario,$last_id_usuario_roles );
		$validatedData= $request->validate([

			'name' => ['required', 'string',  'max:255', 'unique:users'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
		]);
		
	

		$user=new user();
		$user->name=$request->name;
		$user->CURP=$curp[0]->curp;
		$user->email= $validatedData['email'];
		$user->email_verified_at=NULL;
		$user->password=Hash::make($validatedData['password']);
		$user->pwd_des=$request->password;
		$user->roles_id= $rol_id;
		$user->empleados_id= $empleado_id;
		$user->activo=1;
		$user->remember_token=NULL;
		$user->externo=0;
		$user->created_at=now();
		$user->updated_at=now();
		$user->save();
		//dd($last_id_usuario_roles);
		$asigna_roles=new asigna_roles();
		$asigna_roles->users_id=$last_id_usuario_roles;
		$asigna_roles->roles_id=$rol_id;
		$asigna_roles->activo=1;
		$asigna_roles->created_at=now();
		$asigna_roles->updated_at=now();
		$asigna_roles->save();

	
		
		
        $status="El tercer interesado se ha almacenado correctamente ";
				$type="alert alert-success";				
				return back()->with(compact('status','type'));
	}
	public function edit(user $user)
	{

		$rsr=roles::all();
		return view('usuarios.edit', compact('user','rsr'));

	}

	public function store_externo(Request $request)
	{	
		
		$curp=$request->curp;			
		//dd ($request->all());
		$rol_id=$request->rol_id;
		$empleado_id=$request->empleado_id;
		//dd($rol_id,$empleado_id,'name');
		$existe_usuario=DB::select('SELECT COUNT(*) as cuantos FROM users WHERE CURP="'.$curp.'"');
		$name=$request->name;	
		$user_01= substr ( $name , 0 , 1 );
		$user_02= explode(" ", $name);
		$user=strtolower (($user_01.$user_02[1].'@trijez.mx'));
		$user_03= rand ( 1 , 999 );
		$existe_user = DB::select('SELECT COUNT(*) as cuantos FROM users WHERE email="'.$user.'"');
		if ($existe_user[0]->cuantos)
		{
			$user_full=strtolower (($user_01.$user_02[1].$user_03.'@trijez.mx'));
			//dd('YA existe el usuario',$user, $user_full);
		}
	  else
		  {
			$user_full=strtolower (($user_01.$user_02[1].'@trijez.mx'));
			//dd('NO existe el usuario',$user_full);	

		  }
		//Carácteres para la contraseña
			$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
			$password = "";
			//Reconstruimos la contraseña segun la longitud que se quiera
			for($i=0;$i<8;$i++) 
			{
			   //obtenemos un caracter aleatorio escogido de la cadena de caracteres
			   $password .= substr($str,rand(0,62),1);
			}


		if($existe_usuario[0]->cuantos) //aqui voy 
			{
				dd($existe_usuario[0]->cuantos);
				$status="Ya existe un usuario con los datos proporcionados , únicamente debes asignar otro expediente ";
				$type="alert alert-warning";				
				return back()->with(compact('status','type'));
			}
		else 
			{
				$validatedData= $request->validate([

					
				]);
				$user=new user();
				$user->name=$request->name;
				$user->CURP=$curp;
				$user->email= $user_full;
				$user->email_verified_at=NULL;
				$user->password=Hash::make($password);
				$user->pwd_des=$password;
				$user->roles_id= 11;
				$user->empleados_id= 60;
				$user->activo=1;
				$user->remember_token=NULL;
				$user->externo=1;
				$user->expedientes_id=$request->expediente_id;
				$user->created_at=now();
				$user->updated_at=now();
				$user->save();
				
				$status="Se ha creado el usuario , satisfactoriamente ";
				$type="alert alert-success";				
				return back()->with(compact('status','type'));
			}			
	}

	public function store_externo_expediente(Request $request,expediente $expediente, buzones $buzones)
	{
		$curp=$request->curp;	
		$existe_usuario=DB::select('SELECT COUNT(*) as cuantos FROM users WHERE CURP="'.$curp.'"');
		$existe_user=$existe_usuario[0]->cuantos;
		//dd($existe_usuario[0]->cuantos);
		$last_id_user= DB::select('SELECT AUTO_INCREMENT as last_id
		FROM  INFORMATION_SCHEMA.TABLES
		WHERE TABLE_SCHEMA = "trijez"
		AND   TABLE_NAME   = "users"');
		$last_id_usuario=($last_id_user[0]->last_id);

		$last_id_usuario_buzon=($last_id_user[0]->last_id)-1;
		//dd($last_id_usuario, $last_id_usuario_buzon);
		
		if($existe_user) //aqui voy 
			{
				$status="Ya existe un usuario con los datos proporcionados , únicamente debes asignar otro expediente ";
				$type="alert alert-warning";				
				return back()->with(compact('status','type','existe_user'));
			}
		else 
		{
		
			$rol_id=$request->rol_id;
			$empleado_id=$request->empleado_id;		
			//$last_id= DB::select('SELECT MAX(id) as ultimo FROM users');
			$id_usuario=$last_id_usuario;
			$nombre_usuario_buzon= $expediente->actor;
			$validatedData= $request->validate([

				'name' => ['required', 'string',  'max:255'],
				'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
				'password' => ['required', 'string', 'min:8', 'confirmed'],
				'email_notificacion' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			]);

			$expediente->nuevo=0;
			$expediente->updated_at=now();
			$expediente->save();
			
		

			$user=new user();
			$user->name=$request->name;		
			$user->CURP=$request->curp;
			$user->email= $validatedData['email'];
			$user->email_verified_at=NULL;
			$user->password=Hash::make($validatedData['password']);
			$user->pwd_des=$request->password;
			$user->roles_id= 11;
			$user->empleados_id= 60;
			$user->activo=1;
			$user->remember_token=NULL;
			$user->externo=1;
			$user->expedientes_id=$expediente->id;
			$user->email_notificacion= $validatedData['email_notificacion'];
			$user->created_at=now();
			$user->updated_at=now();
			$user->save();

			$buzones=new buzones();
			$buzones->descripcion= 'Buzón de '. $nombre_usuario_buzon;
			$buzones->users_id=$id_usuario;
			$buzones->activo= 0;		
			$buzones->updated_at= now();
			$buzones->created_at= now();
			$buzones->save();

			$ae=new asigna_expedientes();
			$ae->expedientes_id=$expediente->id;
			$ae->users_id=$id_usuario;
			$ae->updated_at= now();
			$ae->created_at= now();
			$ae->save();
			//dd('ojo');
			$status="Usuario asignado exitosamente";
			//$type="alert alert-success";
			$type="success";				
			return back()->with(compact('status','type'));
				//return view('usuarios.create_externo_expediente')->with(compact('status','type'));		
		}
	}
	public function store_terceros(Request $request,expediente $expediente, buzones $buzones)
	{
		//dd($request);	
		$curp=$request->curp;
		$existe_usuario=DB::select('SELECT COUNT(*) as cuantos FROM users WHERE CURP="'.$curp.'"');
		$name=$request->name;
			
		$user_01= substr ( $name , 0 , 1 );
		$user_02= explode(" ", $name);
		$user=strtolower (($user_01.$user_02[1].'@trijez.mx'));
		//dd($name, $user);
		$user_03= rand ( 1 , 999 );
		//$user_full=strtolower (($user_01.$user_02[1].$user_03.'@trijez.mx'));
		//dd($user_full);
		$existe_user = DB::select('SELECT COUNT(*) as cuantos FROM users WHERE email="'.$user.'"');
		//dd($existe_user, $user);
		if ($existe_user[0]->cuantos)
			{
				$user_full=strtolower (($user_01.$user_02[1].$user_03.'@trijez.mx'));
				//dd('YA existe el usuario',$user, $user_full);
			}
		  else
		  	{
				$user_full=strtolower (($user_01.$user_02[1].'@trijez.mx'));
				//dd('NO existe el usuario',$user_full);	

		  	}
			//Carácteres para la contraseña
				$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
				$password = "";
				//Reconstruimos la contraseña segun la longitud que se quiera
				for($i=0;$i<8;$i++) 
				{
				   //obtenemos un caracter aleatorio escogido de la cadena de caracteres
				   $password .= substr($str,rand(0,62),1);
				}
				//Mostramos la contraseña generada
			//dd($existe_usuario[0]->cuantos);
		if($existe_usuario[0]->cuantos) //aqui voy 
			{
				$curprs=user::with('expedientes')->where('email',$user)->get(); ///$user??????
				$curp=$curprs[0]->CURP;
				$user_id=$curprs[0]->id;
				$status="Ya existe un usuario con los datos proporcionados , únicamente debes asignar otro expediente ";
				$type="alert alert-warning";
				//dd($user_id);				
				$view=1;
				//dd($view);
				return back()->with(compact('status','type','user_id','view'));
			}
		else {
			
			$rol_id=$request->rol_id;
				$empleado_id=$request->empleado_id;
				$last_id= DB::select('SELECT MAX(id) as ultimo FROM users');
				$id_usuario=($last_id[0]->ultimo)+1;
				$nombre_usuario_buzon= $request->name;
				//dd($nombre_usuario);
				//dd($id_usuario);
				$validatedData= $request->validate([

				]);

				$expediente->nuevo=0;
				$expediente->updated_at=now();
				$expediente->save();
				
	

				$user=new user();
				$user->name=$request->name;
				$user->CURP=$request->curp;
				$user->email= $user_full;
				$user->email_verified_at=NULL;
				$user->password=Hash::make($password);
				$user->pwd_des=$password;
				$user->roles_id= 11;
				$user->empleados_id= 60;
				$user->activo=1;
				$user->remember_token=NULL;
				$user->externo=1;
				$user->expedientes_id=$expediente->id;
				$user->created_at=now();
				$user->updated_at=now();
				$user->save();

				$buzones=new buzones();
				$buzones->descripcion= 'Buzón de '. $nombre_usuario_buzon;
				$buzones->users_id=$id_usuario;
				$buzones->activo= 0;		
				$buzones->updated_at= now();
				$buzones->created_at= now();
				$buzones->save();


				$ae=new asigna_expedientes();
				$ae->expedientes_id=$expediente->id;
				$ae->users_id=$id_usuario;
				$ae->updated_at= now();
				$ae->created_at= now();
				$ae->save();
				//dd("hola");
				$status="Usuario asignado exitosamente ";
				$type="alert alert-success";
				//return view('users.create_externo_expediente')->with('status','type');				
				return back()->with(compact('status','type'));
			}
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
		'password' => 'confirmed',

		]);
		
		$user->name= $validatedData['name'];
		$user->email= $validatedData['email'];
		$user->password = Hash::make($request->password);
		$user->pwd_des=$request->password;
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
