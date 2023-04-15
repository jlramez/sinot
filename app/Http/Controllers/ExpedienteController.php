<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\expediente;
use App\puestos;
use App\juicio;
use App\interposicion;
use App\estatus;
use App\ponencias;
use App\magistrados;
use App\User;
use Illuminate\Support\Facades\DB;

class ExpedienteController extends Controller
{
     public function __construct()
    {

    	$this->middleware('auth');

    }
	public function index(Request $request)
	{
		
		$folio=$request->get('search');
		$expedientes=expediente::with('ponencias')->orderBy('id','ASC')
			->folio($folio)
			->paginate(10);
			//$rsu=user::with('expedientes')->paginate();
		//$expedientes=expediente::with('ponencias')->paginate(10);		
		return view('expediente.admin',compact('expedientes'));

	}

	public function edit(expediente $expediente)
	{
		$rsj=juicio::all();
		$rsi=interposicion::all();
		$rse=estatus::all();
		$rsp=ponencias::all();
	
		
		return view('expediente.edit', compact('expediente','rsj', 'rsi', 'rse','rsp'));

	}


	public function update(Request $request, expediente $expediente)
	{
			
		//dd ($request->all());
		$id_interposicion=$request->interposicion_id;
		$id_juicio=$request->juicios_id;
		$id_estatus=$request->estatus_id;
		$id_sexo=$request->sexo;
	
		
		//dd ($request->all());
		//dd ($request->all(), $id_interposicion,$id_juicio,$id_estatus);


		$validatedData= $request->validate([

			'folio' => 'required|min:7|max:255',
			'actor' => 'required|min:3|max:255',
			'denunciado' => 'required|min:2|max:255',
			'accion' => 'required|min:2|max:255',
			'terceros' => 'required|min:2|max:255',
			'fecha' => 'required|min:2|max:255',
			'hora' =>  'required|min:2|max:255',
		
			
	
			]);
			
		$fecha=$validatedData['fecha'];	
		$fecha_int=strtotime($fecha);
		$anio= date("Y", $fecha_int);


		$expediente->folio= $request->folio;
		$expediente->interposicion_id= $id_interposicion;
		$expediente->actor= $validatedData['actor'];
		$expediente->denunciado= $validatedData['denunciado'];
		$expediente->accion= $validatedData['accion'];
		$expediente->terceros_interesados= $validatedData['terceros'];
		$expediente->sexo= $id_sexo;
		$expediente->fecha= $validatedData['fecha'];
		$expediente->hora= $validatedData['hora'];
		$expediente->consecutivo= $expediente->consecutivo;
		$expediente->grupo= $expediente->grupo;
		$expediente->estatus_id= $id_estatus;
		$expediente->users_id=1;
		$expediente->ponencias_id= $request->ponencias_id; //aqui dar de aslta el magistrado
		$expediente->juicios_id= $id_juicio;
		$expediente->updated_at= now();
		$expediente->created_at= now();
		$expediente->save();
		//dd ($request->all(), $id_interposicion,$id_juicio,$id_estatus);
        $status="El registro se ha actualizado correctamente";
		return back()->with(compact('status'));
		
	}
	public function create(expediente $expedientes)
	{
	
		$rsj=juicio::orderby('descripcion')->get();
		$rsi=interposicion::orderby('descripcion')->get();
		$rse=estatus::orderby('descripcion')->get();
		$rsm=magistrados::with('ponencias')->where('activo',1)->orderby('primerapellido')->get();
		//dd($rsm->ponencias);
		return view('expediente.create', compact('rsj', 'rsi', 'rse','rsm'));

	}

	public function show(expediente $expediente)
	{
		
		return view('expediente.show', compact('expediente'));


	}

	public function store(Request $request)
	{
			
		//dd ($request->all());
		$ponencia_id=ponencias::where('magistrados_id',$request->magistrados_id)->first();
		$id_interposicion=$request->interposicion_id;
		$id_juicio=$request->juicios_id;
		$id_estatus=$request->estatus_id;
		$id_sexo=$request->sexo;
		
		//dd ($request->all());
		//dd ($request->all(), $id_interposicion,$id_juicio,$id_estatus);


		$validatedData= $request->validate([

			'actor' => 'required|min:3|max:255',
			'email_actor' => 'required', 'string', 'email', 'max:255', 'unique:expedientes',
			'denunciado' => 'required|min:2|max:255',
			'accion' => 'required|min:2|max:255',
			'terceros' => 'required|min:2|max:255',
			'fecha' => 'required|min:2|max:255',
			'hora' =>  'required|min:2|max:255',
		
			
	
			]);
			if ($id_juicio==1)
			{
				$prefix='JDC';
				
				
			}
			if ($id_juicio==2)
			{
				$prefix='RR';
				
				
			}
			if ($id_juicio==3)
			{
				$prefix='JNE';
				
				
			}
			if ($id_juicio==4)
			{
				$prefix='JRL';
				
				
			}	if ($id_juicio==5)
			{
				$prefix='AG';
				
				
			}
				if ($id_juicio==6)
			{
				$prefix='PES';
				
				
			}

				if ($id_juicio==7)
				{
					$prefix='JE';
					
					
				}
		
		$fecha=$validatedData['fecha'];	
		$fecha_int=strtotime($fecha);
		$anio= date("Y", $fecha_int);
		$maximo=DB::select('SELECT MAX(consecutivo) as contador FROM expedientes WHERE juicios_id='.$id_juicio);
				
		if ($id_juicio==1||$id_juicio==2||$id_juicio==3||$id_juicio==5)
		{
			$grupo='1';
			//$maximo=DB::select('SELECT MAX(consecutivo) as contador FROM expedientes WHERE grupo='.$grupo);
			
		}
		if ($id_juicio==4||$id_juicio==6||$id_juicio==7)
		{
			$grupo='2';
			//$maximo=DB::select('SELECT MAX(consecutivo) as contador FROM expedientes WHERE grupo='.$grupo);
		
		}
	 
		$consecutivo_siguiente=intval($maximo[0]->contador) + 1;
		$folio='TRIJEZ-'.$prefix.'-'.$anio.'-00'.($consecutivo_siguiente);
		//dd($maximo,$anio,$grupo,$prefix,$folio,$consecutivo_siguiente);	
		//dd ($request->all(), $id_interposicion,$id_juicio,$id_estatus);
		$expediente=new expediente();
		$expediente->folio= $folio;
		$expediente->interposicion_id= $id_interposicion;
		$expediente->actor= $validatedData['actor'];
		$expediente->email_actor= $validatedData['email_actor'];
		$expediente->denunciado= $validatedData['denunciado'];
		$expediente->accion= $validatedData['accion'];
		$expediente->terceros_interesados= $validatedData['terceros'];
		$expediente->sexo= $id_sexo;
		$expediente->fecha= $validatedData['fecha'];
		$expediente->hora= $validatedData['hora'];
		$expediente->anio= $anio;
		$expediente->consecutivo= $consecutivo_siguiente;
		$expediente->grupo= $grupo;
		$expediente->estatus_id= $id_estatus;
		$expediente->users_id=auth()->user()->id;//user creo
		$expediente->ponencias_id= $ponencia_id->id;
		$expediente->juicios_id= $id_juicio;
		$expediente->updated_at= now();
		$expediente->created_at= now();
		$expediente->save();
		//dd ($request->all(), $id_interposicion,$id_juicio,$id_estatus);
		$status="El expediente se ha almacenado de manera correcta";
		$type="success";
		//$type="alert alert-success";				
		return back()->with(compact('status','type'));
		
		
	}
	public function destroy(Request $request, expediente $expediente)
	{
	
        //dd ($request->all());
		//$area->$area::find($id);
		$expediente->delete();
		//Flash::warning('El área ha sido eliminada');
		//return redirect()->route('admin_area');

	    /*$this->emit('sweet-alert', 'la información se borro correctamente');
        $this->resetPage();*/
		$status="Expediente creado con éxito";
		//return back()->with(compact('status'));
		return redirect()->route('admin_expediente');


	}

}
