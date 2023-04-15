<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\asigna_expedientes;
use App\expediente;
use DateTimeInterface;
use Illuminate\Support\Facades\DB;



class AsignaExpedientesController extends Controller
{
    public function __construct()
    {

    	$this->middleware('auth');

    }
	public function serializeDate(DateTimeInterface $date)
	{
		return $date->format('Y-m-d H:i:s');
	}
	public function index(user $usuario)
	{
        $id_user=$usuario->id;
		//dd($id_user);
		$ae=asigna_expedientes::with('usuarios')->
		where('users_id',$id_user)->paginate(10);
		dd($ae);

		return view('asigna_expedientes.admin', compact('usuario','ae'));

	}
	public function show(user $usuario, asigna_expedientes $ae)
	{
		$id_usuario=$usuario->id;
		//dd($id_usuario);
		$ae=asigna_expedientes::with('users','expedientes')->where('users_id',$id_usuario)->paginate(10);
		//dd($ae);
		//dd($usuario->name);
		return view('asigna_expedientes.show', compact('usuario','ae'));

	}

	public function create(user $usuario)
	{
		//dd($usuario);
		$id_usuario=$usuario->id;
		//dd($id_usuario);

		$rse=expediente::with('ponencias')->get();
		$rsu=user::with('roles')->get();
		$rsae=asigna_expedientes::with('users','expedientes')->where('users_id',$id_usuario)->get();
		return view('asigna_expedientes.create_ae_user', compact('usuario','rsu','rse','rsae'));

	}
	public function store(Request $request, user $usuarios, expediente $expediente)
	
	{
		//$expedientes_id=$request->expedientes_id;
		//dd($rol->id);
		//dd($request->users_id);
	  
		$expedientes_folio= explode(',', $request->expedientes_folio);//create array from separated/coma permissions
		//dd($expedientes_folio);
		foreach($expedientes_folio as $expedientes=>$folio)
			{
				$id_expediente=expediente::with('users')->where('folio',$folio)->get();
				 $existe_expediente=DB::select('SELECT COUNT(*) as  cuantos FROM expedientes WHERE folio= "'.$folio.'"');
					if($existe_expediente[0]->cuantos==0)
						{
							//dd("no existe");
							$status="No existe el folio, o no lo ha capturado, favor de verificar ";
							$type="alert alert-danger";				
							return back()->with(compact('status','type'));	
						}					
					else{
							//dd("si existe");	
							$ae=new asigna_expedientes();
							$ae->expedientes_id=$id_expediente[0]->id;
							$ae->users_id=$request->users_id;
							$ae->updated_at= now();
							$ae->created_at= now();
							$ae->save();
							//dd("no existe");
							
						}				
			}		
	
			$status="El expediente se ha asignado correctamente ";
			$type="alert alert-success";				
			return back()->with(compact('status','type'));
	}

}
