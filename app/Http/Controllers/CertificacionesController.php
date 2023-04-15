<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\asigna_actuaciones;
use App\actuacion;
use App\expediente;
use App\certificaciones;
use Illuminate\Support\Facades\Storage;

class CertificacionesController extends Controller
{
    public function __construct()
    {

    	$this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
    $nombre=$request->get('search');
            $folio=$request->folio;
		$certificaciones=certificaciones::with('asigna_actuaciones')->paginate(10);

		//$empleados=empleado::with('puestos')->paginate(10);
		//dd($certificaciones);
		
		return view('certificaciones.admin', compact('certificaciones'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(asigna_actuaciones $aa, expediente $expediente)
    {
        $rsact=actuacion::all();
        //dd($aa);
		//dd($expediente->id);
		//dd($aact->id);
		
		
		//dd($rsad);
		return view('certificaciones.create', compact('aa','rsact'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, asigna_actuaciones $aa)
    {
      
        $certificado=0;
		if ($request->certificacion=="on")
		{ 
			$certificado=1;
		}
	
			
		//dd($request,$certificado);
		//dd($aact->id);
	            //dd($aact);
				$actuacion=actuacion::where('id',$aa->actuacions->id)->first();
				//dd($actuacion);

				/*$folio=$expediente->folio;
				$exp_id=$expediente->id;*/
				//dd($folio, $exp_id, $request->actuacion_id,auth()->user()->id,$request->autorizada,$request->res_act, $nombre_dcto);
				$validatedData= $request->validate([
					'fojas' => 'required',
				
				]);//aqui
				//dd($folio, $exp_id, $request->actuacion_id,auth()->user()->id,$request->autorizada,$request->res_act, $nombre_dcto);
				/*$aact=new asigna_actuaciones();			
				$aact->folio= $folio;
				$aact->expedientes_id= $exp_id;
				$aact->actuacions_id= $request->actuacion_id;
				$aact->user_id= auth()->user()->id;
				$aact->autorizada=1;
				$aact->resumen_actuacion= $request->res_act;
				$aact->certificado= $certificado;	
				$aact->updated_at= now();
				$aact->created_at= now();
				$aact->save();*/
				$id_aa=$aa->id;
				$folio=$aa->folio;
                $fojas=$request->fojas;
                

				$max_size=(int)ini_get('upload_max_filesize')*10240;
				if($request->hasFile('documento'))
				{
					$documentos=$request->file('documento');
					foreach($documentos as $documento)
						{
							$file_name=encrypt($documento->getClientOriginalName()).'.'.$documento->getClientOriginalExtension();
							if(Storage::PutFileAs('/public/'.$folio.'/'.$actuacion->Nombre.'/'.'certificaciones/', $documento,  $documento->getClientOriginalName()))
								{
									certificaciones::create([
									'asigna_actuaciones_id'=>$id_aa,
									'nombre_dcto'=>$documento->getClientOriginalName(),
									'code_name' => $file_name,
                                    'fojas' => $fojas,
                                    'merge_dcto' => NULL,
									'created_at'=>now(),
									'updated_at'=>now()	
									]);

									$aa->adjunto=1;
									$aa->save();
								}				

							
						
						}
				}
			$status="El registro se ha guardado correctamente";
		return back()->with(compact('status'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(certificaciones $certificacion)
    {
       
		return view('certificaciones.show', compact('certificacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(certificaciones $certificaciones)
    {
		$rsact=actuacion::all();
        //dd($aa);
		//dd($expediente->id);
		//dd($aact->id);
		
		
		//dd($rsad);
		return view('certificaciones.edit', compact('certificaciones','rsact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,certificaciones $certificaciones)
    {
		$certificado=0;
		if ($request->certificacion=="on")
		{ 
			$certificado=1;
		}
	
			
		//dd($request,$certificado);
		//dd($aact->id);
	            //dd($aact);
				$actuacion=actuacion::where('id',$certificaciones->asigna_actuaciones->actuacions->id)->first();
				//dd($actuacion);

				/*$folio=$expediente->folio;
				$exp_id=$expediente->id;*/
				//dd($folio, $exp_id, $request->actuacion_id,auth()->user()->id,$request->autorizada,$request->res_act, $nombre_dcto);
				$validatedData= $request->validate([
					'fojas' => 'required',
				
				]);//aqui
				//dd($folio, $exp_id, $request->actuacion_id,auth()->user()->id,$request->autorizada,$request->res_act, $nombre_dcto);
				/*$aact=new asigna_actuaciones();			
				$aact->folio= $folio;
				$aact->expedientes_id= $exp_id;
				$aact->actuacions_id= $request->actuacion_id;
				$aact->user_id= auth()->user()->id;
				$aact->autorizada=1;
				$aact->resumen_actuacion= $request->res_act;
				$aact->certificado= $certificado;	
				$aact->updated_at= now();
				$aact->created_at= now();
				$aact->save();*/
				$id_aa=$certificaciones->asigna_actuaciones->id;
				$folio=$certificaciones->asigna_actuaciones->folio;
                $fojas=$request->fojas;
                

				$max_size=(int)ini_get('upload_max_filesize')*10240;
				if($request->hasFile('documento'))
				{
					$documentos=$request->file('documento');
					foreach($documentos as $documento)
						{
							$file_name=encrypt($documento->getClientOriginalName()).'.'.$documento->getClientOriginalExtension();
							if(Storage::PutFileAs('/public/'.$folio.'/'.$actuacion->Nombre.'/'.'certificaciones/', $documento,  $documento->getClientOriginalName()))
								{
									
									$certificaciones->asigna_actuaciones_id=$id_aa;
									$certificaciones->nombre_dcto=$documento->getClientOriginalName();
									$certificaciones->code_name =$file_name;
                                    $certificaciones->fojas =$fojas;
									$certificaciones->merge_dcto =NULL;
									$certificaciones->estatus =1;
									$certificaciones->updated_at=now();
									$certificaciones->save();	
									
								}				

							
						
						}
				}
			$status="El registro se ha actualizado correctamente";
		return back()->with(compact('status'));
    }

    public function autoriza(certificaciones $certificacion)
	{
		//dd($user->id);
		return view('certificaciones.autoriza', compact('certificacion'));

	}
	public function certificar(certificaciones $certificacion)
	{
		 
	 $firmada=$certificacion->firmada;
		
		 if($firmada==0)
		 {			 
			//dd($firmada);
			$firmada=1;
		 //dd($activo);
			 $certificacion->firmada=$firmada;
			 $certificacion->save();
			 $type="alert alert-success";
			 $status="El registro se ha sido  certificado correctamente";
			 return back()->with(compact('status','type'));
			 
		 }	
		 elseif($firmada==1)
		 {
			//dd($firmada);
			$status="El registro ya ha sido  certificado anteriormente";
			$type="alert alert-warning";
			return back()->with(compact('status','type'));
		 }

 
	 }
   public function modify_autoriza(certificaciones $certificacion)
   {
		
	$estatus=$certificacion->estatus;
		//dd($activo);
		if($estatus==1)
		{
			$estatus=0;
			$firmada=0;
		//dd($activo);
			$certificacion->estatus=$estatus;
			$certificacion->firmada=$firmada;
			$certificacion->save();
			$como='Rechazado';	
			//dd($activo);
		}	
		elseif($estatus==0)
		{
			$estatus=1;
			$firmada=1;
			//dd($activo);
			$certificacion->estatus=$estatus;
			$certificacion->save();
			$como='Aceptado';		
			//dd($activo);
		}
$status="El registro se ha ". $como ." correctamente";
return back()->with(compact('status'));

	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
