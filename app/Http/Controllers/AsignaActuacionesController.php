<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\expediente;
use App\asigna_actuaciones;
use App\actuacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\asigna_tareas;
use App\asigna_documentos;

class AsignaActuacionesController extends Controller
{
    
	public function __construct()
    {

    	$this->middleware('auth');

    }
	public function create(expediente $expediente)
	{
		$rsact=actuacion::all();
		//dd($expediente->id);
		//dd($aact->id);
		
		
		//dd($rsad);
		return view('asigna_actuaciones.create', compact('expediente','rsact'));

	}

	public function store(Request $request, expediente $expediente, asigna_actuaciones $aact)
	
	{
		$certificado=0;
		if ($request->certificacion=="on")
		{ 
			$certificado=1;
		}
	
			
		//dd($request,$certificado);
		//dd($aact->id);
	            //dd($aact);
				$actuacion=actuacion::where('id',$request->actuacion_id)->first();
				//dd($actuacion);

				$folio=$expediente->folio;
				$exp_id=$expediente->id;
				//dd($folio, $exp_id, $request->actuacion_id,auth()->user()->id,$request->autorizada,$request->res_act, $nombre_dcto);
				$validatedData= $request->validate([
					'actuacion_id' => 'required',
				
				]);//aqui
				//dd($folio, $exp_id, $request->actuacion_id,auth()->user()->id,$request->autorizada,$request->res_act, $nombre_dcto);
				$aact=new asigna_actuaciones();			
				$aact->folio= $folio;
				$aact->expedientes_id= $exp_id;
				$aact->actuacions_id= $request->actuacion_id;
				$aact->user_id= auth()->user()->id;
				$aact->autorizada=1;
				$aact->resumen_actuacion= $request->res_act;
				$aact->certificado= $certificado;	
				$aact->updated_at= now();
				$aact->created_at= now();
				$aact->save();
				$id_asigna_actuacion=$aact->id;
				$folio=$aact->folio;

				$max_size=(int)ini_get('upload_max_filesize')*10240;
				if($request->hasFile('documento'))
				{
					$documentos=$request->file('documento');
					foreach($documentos as $documento)
						{
							$file_name=encrypt($documento->getClientOriginalName()).'.'.$documento->getClientOriginalExtension();
							if(Storage::PutFileAs('/public/'.$folio.'/'.$actuacion->Nombre.'/', $documento,  $documento->getClientOriginalName()))
								{
									asigna_documentos::create([
									'asigna_actuaciones_id'=>$id_asigna_actuacion,
									'nombre_dcto'=>$documento->getClientOriginalName(),
									'code_name' => $file_name,
									'created_at'=>now(),
									'updated_at'=>now()	
									]);
								}				

							
						
						}
				}

			$status="La actuación se asigno al expediete exitosamente";
			$type="success";
		return back()->with(compact('status','type'));

	}

	public function edit(asigna_actuaciones $aa)
	{
		
		//dd($aa);
		$rsact=DB::select('SELECT Nombre FROM actuacions WHERE id='.$aa->actuacions_id);
		$nombre_act=$rsact[0]->Nombre;
		$id_expediente=$aa->expedientes_id;
		
		return view('asigna_actuaciones.autorizar', compact('aa','nombre_act','id_expediente'));

	}

	public function edit_actuaciones(asigna_actuaciones $aa)
	{
		//dd ($aa->id);
		$rsact=actuacion::all();
		$rsad=asigna_documentos::where('asigna_actuaciones_id',$aa->id)->get();
		//dd($rsad->id);
		return view('asigna_actuaciones.edit_actuacion', compact('aa','rsact','rsad'));

	}
	
	public function update_actuaciones(Request $request, asigna_actuaciones $aa, expediente $expediente)
	
	{
		//dd($request->documento);
		$actuacion=$aa->actuacions->Nombre;
		//dd($actuacion);
		$folio=$aa->folio;
		$exp_id=$aa->expedientes_id;
		//dd($folio, $exp_id);
		$validatedData= $request->validate([
		
		]);//aqui
		//dd($folio, $exp_id, $request->actuacion_id,auth()->user()->id,$request->autorizada,$request->res_act);
		//$aa=new asigna_actuaciones();			
		$aa->folio= $folio;
		$aa->expedientes_id= $exp_id;
		$aa->actuacions_id= $request->actuacion_id;
		$aa->user_id= auth()->user()->id;
		$aa->autorizada=1;
		$aa->resumen_actuacion= $request->res_act;	
		$aa->updated_at= now();
		$aa->created_at= now();
		$aa->save();
		$id_asigna_actuacion=$aa->id;
		$folio=$aa->folio;

		$max_size=(int)ini_get('upload_max_filesize')*10240;
		if($request->hasFile('documento'))
		{
			$documentos=$request->file('documento');
			foreach($documentos as $documento)
			{
				$file_name=encrypt($documento->getClientOriginalName()).'.'.$documento->getClientOriginalExtension();
				if(Storage::PutFileAs('/public/'.$folio.'/'.$actuacion.'/', $documento,  $documento->getClientOriginalName()))
					{
						asigna_documentos::create([
						'asigna_actuaciones_id'=>$id_asigna_actuacion,
						'nombre_dcto'=>$documento->getClientOriginalName(),
						'code_name' => $file_name,
						'created_at'=>now(),
						'updated_at'=>now()	
						]);
					}				

				
			
			}
		}
		
			
			$status="El registro se ha actualizado correctamente";
		return back()->with(compact('status'));

	}

	public function update(asigna_actuaciones $aa)
	
	{
		//dd ($aa);
				$autorizada=$aa->autorizada;
				//dd($activo);
				if($autorizada==1)
				{
					$autorizada=0;
				//dd($activo);
					$aa->autorizada=$autorizada;
					$aa->save();
					$como='desautorizado';	
					//dd($activo);
				}	
				elseif($autorizada==0)
				{
					$autorizada=1;
					//dd($activo);
					$aa->autorizada=$autorizada;
					$aa->save();
					$como='autorizado';		
					//dd($activo);
				}
			$status="La actuación se ha ". $como ." correctamente";
		return back()->with(compact('status'));

	}

	public function show_aa(expediente $expediente,asigna_actuaciones $aa)
	{
		//$id_expediente=$aa->first()->expedientes_id;
		$id_expediente=$expediente->id;
		$asigna_actuaciones_id=$aa->id;
		/*$aa=DB::select('SELECT asigna_documentos.nombre_dcto,actuacions.Nombre, asigna_actuaciones.id, asigna_actuaciones.folio, asigna_actuaciones.autorizada, asigna_actuaciones.id  as id   
		FROM asigna_actuaciones,actuacions,asigna_documentos WHERE asigna_actuaciones.expedientes_id='.$id_expediente.' 
		and actuacions.id=asigna_actuaciones.actuacions_id and asigna_documentos.asigna_actuaciones_id=asigna_actuaciones.id');*/
		$aa=asigna_actuaciones::with('actuacions','asigna_documentos','certificaciones')->where('expedientes_id',$id_expediente)->get();
		//$id_actuacion=$aa[0]->id;
		//dd($aa[0]->expedientes_id);
		$aa_cuantos=DB::select('SELECT COUNT(*) as cuantos FROM asigna_actuaciones WHERE expedientes_id='.$id_expediente);
		//dd($aa_cuantos);
		if($aa_cuantos[0]->cuantos>0)
			{
				//dd("si hay actuaicones");
				if ($aa){	
					$id_actuacion=$aa[0]->id;	
					$existe_notificacion=DB::select('SELECT COUNT(*) as cuantos FROM notificaciones WHERE asigna_actuaciones_id='.$id_actuacion);
					$existe=$existe_notificacion[0]->cuantos;
					//dd('entro al if');
					return view('asigna_actuaciones.admin', compact('expediente','aa', 'existe'));
					
						}
				else
				{
					//dd('no entro al if');
					return view('asigna_actuaciones.admin', compact('expediente','aa'));
				}
			}
		else 
			{
				//dd("no hay actuaciones");
				$status="El expediente no tiene actuaciones, favor de realizar alguna.";
				//$type="alert alert-warning";				
				//return back()->with(compact('expediente','aa','status','type'));
				return view('asigna_actuaciones.admin')->with(compact('status','expediente','aa'));
			}
		//dd($existe_notificacion[0]->cuantos);
		//$existe=$existe_notificacion[0]->cuantos;
		

	}
	public function show($id_aa)
	{
		$id_asigna_actuacion=intval($id_aa);
        // dd($id_actuacion);
		//$aa=DB::select('SELECT * FROM asigna_actuaciones,actuacions,users WHERE asigna_actuaciones.user_id=users.id AND actuacions.id=asigna_actuaciones.actuacions_id AND asigna_actuaciones.id='.$id_asigna_actuacion);
		$aa=asigna_actuaciones::with('user','actuacions','certificaciones')
		->where('id',$id_asigna_actuacion)->get();
		//dd($aa, $id_asigna_actuacion);
		return view('asigna_actuaciones.show_actuacion', compact('aa','id_asigna_actuacion'));

	}
	

	protected function downloadFile($src)
	{
		dd($src);
		if(is_file($src)){
			dd($src);
			$finfo=finfo_open(FILEINFO_MIME_TYPE);
			$content_type=finfo_file($finfo, $src);
			finfo_close($finfo);
			$file_name=basename($src.PHP_EOL);
			$size= filersize($src);
			header("Content-Type: $content_type");
			header("Content-Disposition:atachment; filename=$file_name");
			header("Content-Transfer-Encoding: binary");
			header("Content-Length:$size");
			readfile($src);
			
			return true;
		} else {
			return false;
		}
	}

	public function download($src)
	{
		if(!$this->downloadFile(app_path().$src))
		{
			return redirect()->back();
		}	

	}

	public function destroy(Request $request, asigna_actuaciones $aa)
	{
	
        //dd ($request->all());
		//$area->$area::find($id);
		//dd($aa);
		$aa->delete();
		//Flash::warning('El área ha sido eliminada');
		//return redirect()->route('admin_area');

	    /*$this->emit('sweet-alert', 'la información se borro correctamente');
        $this->resetPage();*/
		$status="El registro se ha eliminado correctamente";
		//return back()->with(compact('status'));
		return redirect()->route('show_addact',$aa->expedientes_id);


	}
	
}
