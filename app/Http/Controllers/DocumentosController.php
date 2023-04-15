<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\documentos;
use App\asigna_actuaciones;
use App\perfilfirma;
use App\efirma;
use Illuminate\Support\Facades\Storage;

class DocumentosController extends Controller
{
    public function __construct()
    {

    	$this->middleware('auth');

    }
    public function index(perfilfirma $perfilfirma)
    {
        
        $documentos=documentos::with('asigna_actuaciones','perfil_firmas')->paginate(10);
        //$efirma=efirma::with('documentos')->get();
        //dd($documentos[1]->asigna_actuaciones->certificado);
       // $existe_cert=DB::select('SELECT COUNT() ')

        return view('documentos.admin',compact('documentos'));
    }

    public function create(asigna_actuaciones $aa)
	{
		//$rsact=actuacion::all();
		//dd($aa->actuacions->Nombre);
		//dd($aact->id);
		
		
		//dd($rsad);
		$rspf=perfilfirma::all();
		return view('documentos.create', compact('aa','rspf'));

	}
    public function adjuntar_dcto(documentos $documentos)
	{
		return view('documentos.adjuntar', compact('documentos'));
	}

	public function store(Request $request,asigna_actuaciones $aa)
    {
       // dd($actuacion->id, $request);
       
                    $documentos=new documentos();
                    $documentos->asigna_actuaciones_id=$aa->id;
                    $documentos->cuerpo= $request->texto;
					$documentos->perfil_firmas_id= $request->perfilfirma_id;
                    $documentos->updated_at= now();
                    $documentos->created_at= now();
                    $documentos->save();
            
            //}		
                $status="Hoja de firmas generada exitosamente";
                $type="success";
            return back()->with(compact('status','type'));
    }
    public function save(Request $request,documentos $documentos)
    {
        //dd($documentos->id);
       
       $id_documento=$request->id_dcto;
       //dd($id_documento);
       $folio=$request->folio;
       $actuacion=$request->actuacion;
       //dd($folio);
       $max_size=(int)ini_get('upload_max_filesize')*10240;
               if($request->hasFile('documento'))
               {
                           request()->documento->storeAs('/uploads/'.$folio.'/'.$actuacion.'/', request()->documento->getClientOriginalName());
                           $documento=$request->file('documento');
                           $file_name=encrypt($documento->getClientOriginalName()).'.'.$documento->getClientOriginalExtension();
                           if(Storage::PutFileAs('/public/'.$folio.'/'.$actuacion.'/', $documento,  $documento->getClientOriginalName()))
                               {
                                
                                $documentos->nombre_dcto=$documento->getClientOriginalName();;
                                   $documentos->code_name= $file_name;
                                   $documentos->updated_at= now();                   
                                   $documentos->save();
                                   $ruta_origen='/public/'.$folio.'/'.$actuacion.'/'.$documento->getClientOriginalName();
                                   $ruta_destino='/uploads/'.$documento->getClientOriginalName();
                                   $contents = Storage::get('/public/'.$folio.'/'.$actuacion.'/'.$documento->getClientOriginalName());
                                   //dd($ruta_origen, $ruta_destino,$contents);
                                   //move_uploaded_file($ruta_origen, $ruta_destino);
                                   
                               }
                  
            
                }		
                $status="Hoja de firmas generada exitosamente";
                $type="success";
            return back()->with(compact('status','type'));
    }

}
