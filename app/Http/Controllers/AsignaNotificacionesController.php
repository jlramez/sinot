<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\notificaciones;
use App\asigna_notificaciones;
use App\asigna_actuaciones;
use App\asigna_documentos;
use App\asigna_expedientes;
use Illuminate\Support\Facades\DB;
use App\buzones;
use App\expediente;
use App\documentos;
use Alert;
use App\mail\NotificaMailable;
use Illuminate\Support\Facades\Mail;


class AsignaNotificacionesController extends Controller
{
	public function __construct()
    {

    	$this->middleware('auth');

    }
	
	public function index()
	{
		
        $asigna_notificaciones=asigna_notificaciones::all()->paginate(10);
        //dd($buzones);		
		return view('asigna_notificaciones.admin',compact('asigna_notificaciones'));

    }
	public function create(notificaciones $notificacion)
	{
		$rs_not=notificaciones::all();
		//dd($rs_not);
        $rsb=buzones::all();        
		return view('asigna_notificaciones.create', compact('rs_not','notificacion','rsb'));

	}

	public function store(Request $request)
	{

		//dd ($request->all());
		$validatedData= $request->validate([
	

		]);

		$asigna_notificaciones=new asigna_notificaciones();
		$asigna_notificaciones->notificaciones_id=$request->notificaciones_id;
		$asigna_notificaciones->buzones_id=$request->buzones_id;	
		$asigna_notificaciones->created_at= now();
		$asigna_notificaciones->updated_at= now();
		$asigna_notificaciones->save();
		$status="El registro se ha guardado correctamente";
		return back()->with(compact('status'));
	}

	public function store_buzon(asigna_actuaciones $aa)
	{
		//dd($aa->expedientes->email_actor);
		//$id_notificacion=DB::select('SELECT * FROM notificaciones WHERE asigna_actuaciones_id='.$aa->id); CONSULTA ORIGINAL
		$id_notificacion=notificaciones::all()->where('asigna_actuaciones_id', $aa->id )->first();
	
		if (!$id_notificacion)
		{
			$error=1;
						$status="NO ha sido generada la  notificacion de la actuación, PRIMERO debe generarla.";
						return back()->with(compact('status','error'));
		}
		//$id_expediente=DB::select('SELECT * FROM expedientes WHERE email_actor="'.$id_notificacion[0]->email_actor.'"'); CONSULTA ORIGINAL
		$id_expediente=expediente::all()->where('email_actor', $id_notificacion->email_actor)->first();
		//$id_usuario_buzon=DB::select('SELECT * FROM users WHERE expedientes_id='.$id_expediente[0]->id); CONSULTA ORIGINAL
		//$id_usuario_buzon=DB::select('SELECT * FROM asigna_expedientes WHERE expedientes_id='.$id_expediente[0]->id); CONSULTA ORIGINAL
		$id_usuario_buzon=asigna_expedientes::all()->where('expedientes_id', $id_expediente->id);
		//dd($id_usuario_buzon);
		//$cuantos_users=DB::select('SELECT COUNT(*) as no_users FROM users WHERE expedientes_id='.$id_expediente[0]->id);CONSULTA ORIGINAL
		$cuantos_users=DB::select('SELECT COUNT(*) as no_users FROM asigna_expedientes WHERE expedientes_id='.$id_expediente->id);
		$no_users=$cuantos_users[0]->no_users;
		//dd($id_usuario_buzon, $no_users);
		//$id_buzon=DB::select('SELECT * FROM buzones WHERE users_id='.$id_usuario_buzon[0]->id);
		$existe_notificacion=DB::select('SELECT * FROM asigna_notificaciones WHERE notificaciones_id='.$id_notificacion->id);
		$existe_notificacion_cuantos=DB::select('SELECT COUNT(*) as cuantos FROM asigna_notificaciones WHERE notificaciones_id='.$id_notificacion->id);
		//dd($id_notificacion->id, $existe_notificacion,$existe_notificacion_cuantos[0]->cuantos, $id_usuario_buzon, $id_expediente, $id_notificacion);
			
			
					
					if($existe_notificacion_cuantos[0]->cuantos>0)
					{
						
						$error=1;
						$status="Esta actuación ya ha sido notificada";
						return back()->with(compact('status','error'));
					}
					else
					{
			
						foreach($id_usuario_buzon as $item)
						{
							
							//$id_buzon=DB::select('SELECT * FROM buzones WHERE users_id='.$item->id);// consulta original
							$id_buzon=buzones::all()->where('users_id',$item->users_id);
							//dd($id_buzon);			
							foreach($id_buzon as $buzon)
								{	
										if($buzon)							
												{
													//dd($buzon->users);
													$emails[]=$buzon->users->email_notificacion;
													$asigna_notificaciones=new asigna_notificaciones();
													$asigna_notificaciones->notificaciones_id=$id_notificacion->id;
													$asigna_notificaciones->buzones_id=$buzon->id;
													$asigna_notificaciones->notificada=1;
													$asigna_notificaciones->created_at= now();
													$asigna_notificaciones->updated_at= now();
													$asigna_notificaciones->save();
													$correo= new NotificaMailable;
													Mail::to($buzon->users->email_notificacion)->send($correo);								

													//dd($id_notificacion->id);
													$notificacion_updt=notificaciones::where('id', $id_notificacion->id)->first();
													$notificacion_updt->enviado=1;
													$notificacion_updt->save();
												}											
										
										else
												{
													$status_error="No existe buzon, por  favor genere un buzon para el usuario";
													return back()->with(compact('status_error'));
												}

														
								}			
						}
						
					}
								//dd($emails);
								$status="Se ha notificado correctamente  a ".$no_users." interesado(s)";
					
								return back()->with(compact('status'));
		
		}
			
			public function show_an(buzones $buzones)
			{
				//dd($buzones);
				$id_b=$buzones->id;
				//dd($id_b);
				//$id_notificacion=$asigna_notificaciones->id;
				$asigna_notificaciones=asigna_notificaciones::with('buzones')
				->where('buzones_id',$id_b)->get();
				$existe_an=DB::select('SELECT COUNT(*) as cuantos FROM asigna_notificaciones WHERE buzones_id='.$id_b);
				//$hora= date('h:i:s',strtotime($asigna_notificaciones[0]->created_at));
				//dd($hora);
				//dd($existe_an);
				//dd($asigna_notificaciones[0]->buzones->users->id);
				if ($existe_an[0]->cuantos)
				{
					//dd($asigna_notificaciones[0]->id);
				    $rsad=asigna_documentos::where('asigna_actuaciones_id',$asigna_notificaciones[0]->id)->get();
					return view('asigna_notificaciones.admin', compact('asigna_notificaciones','id_b'));
				}
				
					
				
				else
					{

						//$rsad=asigna_documentos::where('asigna_actuaciones_id',$asigna_notificaciones[0]->id)->get();
					return view('asigna_notificaciones.admin', compact('asigna_notificaciones','id_b'));
					}
				 
				

			}

			public function show(asigna_notificaciones $an)
			{
				dd($an);
				//$rsact=asigna_notificaciones::where('')
				//$rsad=asigna_documentos::where('asigna_actuaciones_id',$an->id)->get();
				return view('asigna_notificaciones.show', compact('an'));
		
		
			}

			public function read(Request $request, asigna_notificaciones $an)
			{
				$not_id=$an->notificaciones_id;	
				//dd ($not_id);
				$an->leida= 1;
				$an->readed_at=now();			
				$an->save();
				$rsnot=notificaciones::where('id',$not_id)->first();
				//dd($rsnot->asigna_actuaciones_id);
				//$rsad=asigna_documentos::with('asigna_actuaciones')->where('asigna_actuaciones_id',$rsnot->asigna_actuaciones_id)->get();//consulta orifginal

				
			



				//$aa=asigna_actuaciones::with('asigna_documentos','notificaciones')->where('id',$rsnot->asigna_actuaciones_id)->get(); //sacam,os rtodos los registros unicamente deben ser s del buzon
				//$aa=notificaciones::with('asigna_actuaciones')->where('asigna_actuaciones_id',$rsnot->asigna_actuaciones_id)->get();
				$aa=asigna_notificaciones::with('notificaciones')->where('buzones_id', $an->buzones_id )->get();
				$rsdocs=documentos::with('asigna_actuaciones')->where('asigna_actuaciones_id',$rsnot->asigna_actuaciones_id)->first();
				$rsdocs_cuantos=DB::select('SELECT COUNT(*) as cuantos FROM documentos WHERE asigna_actuaciones_id='.$rsnot->asigna_actuaciones_id );
				//dd($aa[0]->id);
				/*foreach ($rsad as $docs)
					{
						$archivos[]=$docs->nombre_dcto;
					}*/
				
				if 	($rsdocs_cuantos[0]->cuantos>0)
					{
						$hf=$rsdocs->nombre_dcto;
					}
				else
					{
						$status="No existen documentos, por favor contactar al administrador del sietema.";
						return back()->with(compact('status'));
					}
				//dd($archivos);
				return view('asigna_notificaciones.show', compact('an','aa','hf'));
			}
			public function destroy(Request $request, asigna_notificaciones $an)
			{
			
				//dd ($request->all());
				$id=asigna_notificaciones::with('buzones')->find($an->id);
				//dd($id->buzones_id);
				$an->delete();
				//Flash::warning('El área ha sido eliminada');
				//return redirect()->route('admin_area');
		
				//$this->emit('sweet-alert', 'la información se borro correctamente');
				//$this->resetPage();
				$status="El registro se ha eliminado correctamente";
				//return back()->with(compact('status'));
				return redirect()->route('show_addnot',$id->buzones_id);
		
		
			}
}
