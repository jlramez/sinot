<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\notificaciones;
use App\actuacion;
use App\expediente;
use App\asigna_actuaciones;
use App\asigna_notificaciones;
use App\buzones;
use Illuminate\Support\Facades\DB;

class NotificacionesController extends Controller
{
    public function __construct()
    {

    	$this->middleware('auth');

    }
	public function index(request $request)
	{
		//$empleados=empleado::with('puestos')->paginate(10);
		//$notificaciones=notificaciones::with('asigna_actuaciones')->paginate(10);
		$created_at=$request->get('search');
		$notificaciones=notificaciones::with('asigna_actuaciones')
			->orderBy('id','ASC')
			->created_at($created_at)
			->paginate(10);

		$asigna_notificaciones=asigna_notificaciones::with('buzones','notificaciones')->get();
		//dd($asigna_notificaciones->id);	
		return view('notificaciones.admin', compact('notificaciones','asigna_notificaciones'));

	}
	public function show(notificaciones $notificacion)
	{
		
		$i=0;
		$buzon_id=asigna_notificaciones::with('buzones','notificaciones')->where('notificaciones_id',$notificacion->id)->get();
		
		foreach($buzon_id as $bi)
			{
				$idb[]=$bi->buzones->users->name;	

			}
		if (isset($idb))
			{
				$notificacion=asigna_notificaciones::with('buzones','notificaciones')->where('notificaciones_id',$notificacion->id)->get();
				//dd($idb, $notificacion);
				return view('notificaciones.show', compact('notificacion','idb'));
			}
		else 
			{
				$status="No se ha notificado a ningún usuario la actuación seleccionada";
				$type="alert alert-danger";				
				return back()->with(compact('status','type'));

			}

		

	}

	public function create(notificaciones $notificacion )
	{
		$rsact=actuacion::all();
		$rsexp=expediente::all();
		
		return view('notificaciones.create', compact('rsact', 'rsexp'));

	}

	public function create_na(notificaciones $notificacion, asigna_actuaciones $aa)
	{
		$rsact=actuacion::all();
		$rsexp=expediente::all();
		$aact=DB::select('SELECT  asigna_actuaciones.expedientes_id as expediente_id, expedientes.email_actor as email,asigna_actuaciones.id as id_aact, asigna_actuaciones.folio as folio,
		 actuacions.Nombre as nombre_act, asigna_actuaciones.resumen_actuacion as resumen_act,
		  magistrados.nombre as nombre_magistrado, magistrados.primerapellido as ap_magistrado,
		  magistrados.segundoapellido as am_magistrado, expedientes.actor as actor 
		  FROM expedientes,magistrados,asigna_actuaciones,actuacions,ponencias WHERE asigna_actuaciones.id='.$aa->id. 
		  ' AND actuacions.id=asigna_actuaciones.actuacions_id AND asigna_actuaciones.expedientes_id=expedientes.id 
		AND expedientes.ponencias_id=ponencias.id AND ponencias.magistrados_id=magistrados.id' );
		$rs_ue=DB::select('SELECT * FROM users WHERE externo=1');
		//dd ($aact);
		return view('notificaciones.create_na', compact('rsact', 'rsexp','aact','rs_ue'));

	}

	public function store(Request $request)
	{
			
		//dd ($request->all());
		$validatedData= $request->validate([

		'fecha' => 'required|min:2|max:255',	

		]);
		$notificaciones=new notificaciones();
		$notificaciones->asigna_actuaciones_id=$request->asigna_act_id;
		$notificaciones->fecha_not= $request->fecha;//fecha sistema 
		$notificaciones->email_actor= $request->email_actor;
		$notificaciones->usuario_id= auth()->user()->id;		
		$notificaciones->leido= 0;
		$notificaciones->enviado= 0;
		$notificaciones->updated_at= now();
		$notificaciones->created_at= now();
		$notificaciones->save();
		
        $status="El registro se ha insertado correctamente";
		return back()->with(compact('status'));
		
	}

	public function store_notificacion(asigna_actuaciones $aa)
	{
		//dd("aqui es el pedo");
		$existe_notificacion=DB::select('SELECT * FROM notificaciones WHERE asigna_actuaciones_id='.$aa->id);	
		$email_actor=$aa->expedientes->email_actor;

		/*$validatedData= $request->validate([

		'fecha' => 'required|min:2|max:255',	

		]);*/
		if($existe_notificacion)
					{
						//dd("existe");
						$status="Ya se ha generado esta notificación , únicamente debes asignar otro interesado y enviarla";
						$type="alert alert-danger";				
						return back()->with(compact('status','type'));
					}

		else
			{

				//dd("no existe");
				$notificaciones=new notificaciones();
				$notificaciones->asigna_actuaciones_id=$aa->id;
				$notificaciones->fecha_not= date("y-m-d");//fecha sistema 
				$notificaciones->email_actor= $email_actor;
				$notificaciones->usuario_id= auth()->user()->id;		
				$notificaciones->leido= 0;
				$notificaciones->enviado= 0;
				$notificaciones->updated_at= now();
				$notificaciones->created_at= now();
				$notificaciones->save();
				$status="El registro se ha insertado correctamente";
				$type="alert alert-success";	
				return back()->with(compact('status','type'));
			}
				
			
		
	}

	public function edit(empleado $empleado)
	{

		$rsp=puestos::all();
		return view('empleados.edit', compact('empleado', 'rsp'));

	}


	public function update(Request $request, empleado $empleado)
	{
			
		//dd ($request->all());
		$validatedData= $request->validate([

		'nombre' => 'required|min:7|max:255',
		'ap' => 'required|min:2|max:255',
		'ap' => 'required|min:2|max:255',
		'am' => 'required|min:2|max:255',
		'magistrado' => 'required|min:1|max:255',
		'curp' => 'required|min:2|max:255',
		'rfc' => 'required|min:2|max:255',
		'puestos_id' => 'required',
		'email' => 'required|min:2|max:255'

		]);

		$empleado->nombre= $validatedData['nombre'];
		$empleado->ap= $validatedData['ap'];
		$empleado->am= $validatedData['am'];
		$empleado->magistrado= $validatedData['magistrado'];
		$empleado->curp= $validatedData['curp'];
		$empleado->rfc= $validatedData['rfc'];
		$empleado->puestos_id= $validatedData['puestos_id'];
		$empleado->email= $validatedData['email'];
		$empleado->updated_at= now();
		$empleado->created_at= now();
		$empleado->save();
		
        $status="El registro se ha actualizado correctamente";
		return back()->with(compact('status'));
		
	}
	public function autoriza(notificaciones $notificacion)
	{
		//dd($user->id);
		return view('notificaciones.autoriza', compact('notificacion'));

	}

   public function modify_autoriza(notificaciones $notificacion)
   {
		
	$autorizada=$notificacion->autorizada;
		//dd($activo);
		if($autorizada==1)
		{
			$autorizada=0;
		//dd($activo);
			$notificacion->autorizada=$autorizada;
			$notificacion->save();
			$como='no-autorizado';	
			//dd($activo);
		}	
		elseif($autorizada==0)
		{
			$autorizada=1;
			//dd($activo);
			$notificacion->autorizada=$autorizada;
			$notificacion->save();
			$como='autorizado';		
			//dd($activo);
		}
$status="El registro se ha ". $como ." correctamente";
return back()->with(compact('status'));

	}

	public function reporte(Request $request)
	{
		
		//$nombre=$request->get('search');
		/*$expedientes=expedientes::with('users')->orderBy('id','ASC')
			->nombre($nombre)
			->paginate(10);*/

			//$notificaciones=notificaciones::paginate(10);
			$notificaciones=asigna_notificaciones::with('notificaciones')->paginate(10);
	//dd($notificaciones[0]->notificaciones);
			//dd($notificaciones[0]->notificaciones->enviado);


		return view('notificaciones/reporte', compact('notificaciones'));
	}
	public function destroy(Request $request, notificaciones $notificacion)
	{
	
        //dd ($request->all());
		//$area->$area::find($id);
		$notificacion->delete();
		//Flash::warning('El área ha sido eliminada');
		//return redirect()->route('admin_area');

	    /*$this->emit('sweet-alert', 'la información se borro correctamente');
        $this->resetPage();*/
		$status="El registro se ha eliminado correctamente";
		//return back()->with(compact('status'));
		return redirect()->route('admin_notificacion');


	}
}
