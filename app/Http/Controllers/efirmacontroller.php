<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\efirma;
use App\documentos;
use SoapClient;
use Illuminate\Support\Facades\Storage;
use XMLReader;




class efirmacontroller extends Controller
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_documento=$request->id_dcto;
        //dd($id_documento);
        $folio=$request->folio;
        $max_size=(int)ini_get('upload_max_filesize')*10240;
				if($request->hasFile('documento'))
				{
					$documento=$request->file('documento');
							$file_name=encrypt($documento->getClientOriginalName()).'.'.$documento->getClientOriginalExtension();
							if(Storage::PutFileAs('/public/efirma/'.$folio.'/', $documento,  $file_name))
								{
									$efirma=new efirma;
									$efirma->documentos_id=$id_documento;
									$efirma->nombre_dcto=$documento->getClientOriginalName();
									$efirma->code_name = $file_name;
                                    $efirma->efirma = NULL;
									$efirma->created_at=now();
									$efirma->updated_at=now();
                                    $efirma->save();	
									
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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


    public function firmar(documentos $documentos)
    {
                 //Storage::link('exist/test.png', 'move/test_move.png');
                $folio=$documentos->asigna_actuaciones->expedientes->folio;
                $actuacion=$documentos->asigna_actuaciones->actuacions->Nombre;
                $url="http://10.118.11.139:8080/WS_SeguriSign/SeguriSign?wsdl";
                $user="TRIJEZ";
                $pwd="1234tr";
                $key_id="2009";
                //$archivo='uploads/'.$folio.'/'.$actuacion.'/'.$documentos->nombre_dcto;
                $archivo=storage::path('uploads'.'/'.$folio.'/'.$actuacion.'/'.$documentos->nombre_dcto);
                //dd($archivo);
                $fileBinary = fread(fopen($archivo, "r"), filesize($archivo));
                $fileB64 = base64_encode($fileBinary);
                    
                $client = new SoapClient($url, array('proxy_host'=> $url,
                                                        //   'proxy_port'    => 8081,
                                                        'login'    => $user,
                                                        'password' => $pwd));
                                                        $SignRequest =<<<EOT
                                                        <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
                                                        <soap:Body>
                                                        <ProcessMessage xmlns="urn:sgdata">
                                                        <request xmlns:q1="urn:sgdata" xsi:type="q1:SignDocumentRequest" xmlns="">
                                                        <keyid>$key_id</keyid>
                                                        <withContent>true</withContent>
                                                        <docToSign>
                                                        <filename>$archivo</filename>
                                                        <compressed>false</compressed>
                                                        <data>$fileB64</data>
                                                        </docToSign>
                                                        </request>
                                                        </ProcessMessage>
                                                        </soap:Body>
                                                        </soap:Envelope>
                                                        EOT;
                                                        
                                                        
                                                                //Envia petición de firma:
                                                                $SignResponse=$client->__doRequest($SignRequest,$url,"",1);
                                                        
                                                                //Leer Respuesta
                                                               $efirma_ok=$this->readResponse($SignResponse, $client, $archivo, $url);
                                                                //dd($efirma);
                                                                $efirma=new efirma();
                                                                $efirma->documentos_id=$documentos->id;
                                                                $efirma->pkcs7=NULL;
                                                                $efirma->pkcs1=NULL;
                                                                $efirma->efirma=$efirma_ok;
                                                                $efirma->created_at=now();
                                                                $efirma->updated_at=now();
                                                                $efirma->save();

                                                                $documentos->firmado=1;
                                                                $documentos->save();;

                                                                $status="Se ha firmado el documento correctamente";
                                                                return back()->with(compact('status'));

    }               
                Private function readResponse($Response, $client, $archivo, $url)
                    {

                                $reader = new XMLReader ();
                                if ($reader->xml($Response)){

                                    while ($reader->read()) {
                                        if ($this->isElement($reader)){
                                            $element=$this->returnElement($reader);
                                        }
                                        if ($this->isValue($reader)){
                                            $value=$this->returnValue($reader);

                                            if ($element == 'data')

                                            {


                                                $pkcs7 = $value;

                        //INICIA Petición para autenticar:
                                                $verifyRequest=<<<EOT
                            <?xml version="1.0" encoding="UTF-8"?>
                            <env:Envelope xmlns:env="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns0="urn:sgdata">
                            <env:Body>
                            <ns0:ProcessMessage>
                            <request xmlns:q1="urn:sgdata" xsi:type="q1:VerifyRequest" xmlns="">
                            <signedDoc>
                            <filename>$archivo</filename>
                            <compressed>false</compressed>
                            <data>$value</data>
                            </signedDoc>
                            <originalDoc xsi:nil="1"/>
                            <folio xsi:nil="1"/>
                            </request>
                            </ns0:ProcessMessage>
                            </env:Body>
                            </env:Envelope>
                        EOT;
                        //Termina Peticion de Autenticacion.

                        //LLamado a la Verificacion.
                                                $VerifyResponse=$client->__doRequest($verifyRequest,$url,"",1);
                                                return $this->readResponse($VerifyResponse, $client, $archivo, $url);
                                            }
                        //Finzaliza Llamado.
                                            if ($element == 'faultstring')
                                            {
                                                $error = $value;
                                            }
                                            if ($element == 'detail')
                                            {
                                                $error = $error.$value;

                                                return  $error;
                                            }
                                            if ($element == 'sequence')
                                            {
                                                $iSecuencia = $value;
                                                $GetPrintableUnilateralRequest = '
                                                                                                <?xml version="1.0" encoding="utf-8"?>
                                                                                                <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
                                                                                                    <soap:Body>
                                                                                                        <ProcessMessage xmlns="urn:sgdata">
                                                                                                            <request xmlns:q1="urn:sgdata" xsi:type="q1:GetXMLForensicEvidencesUnilateralRequest" xmlns="">
                                                                                                                <idFromVerify>'.$iSecuencia.'</idFromVerify>
                                                                                                            </request>
                                                                                                        </ProcessMessage>
                                                                                                    </soap:Body>
                                                                                                </soap:Envelope>';

                                                $GetPrintableUnilateralResponse = $client->__doRequest($GetPrintableUnilateralRequest, $url, "", 1);

                                                $reader = new XMLReader();
                                                if ($reader->xml($GetPrintableUnilateralResponse)) {
                                                    while ($reader->read()) {
                                                        if ($reader->nodeType == XMLReader::ELEMENT) {
                                                            $element = $reader->localName;
                                                        }

                                                        if ($reader->nodeType == XMLReader::TEXT) {
                                                            if ($element == 'data'){
                                                                $res = base64_decode($reader->value);

                                                                $reader2 = new XMLReader();
                                                                if ($reader2->xml($res)) {
                                                                    while ($reader2->read()) {
                                                                        if ($reader2->nodeType == XMLReader::ELEMENT) {
                                                                            if ($reader2->localName == 'signature') {
                                                                                $char = "0123456789ABCDEFGHIJKLMNOPQRSTUVQXYZ";
                                                                                $pin= $char[rand(0,35)] . $char[rand(0,35)] . $char[rand(0,35)] . $char[rand(0,35)];
                                                                                $iSecuencia .= $pin;
                                                                                $this->Secuencia = $iSecuencia;
                                                                                $reader2->read();
                                                                                $firma = $reader2->value;
                                                                                $this->firma = $firma;
                                                                                $this->pkcs7 = $res;
                                                                                $this->secuencia = $iSecuencia;

                                                                                return $firma;
                                                                                
                                                                             

                                                                            }

                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }else{
                                                    return false;
                                                }
                                                exit(0);
                                            } //if sequence
                                        }
                                    }

                                }
                                else{
                                    return false;

                                }
                                exit(0);
                            }
                            Private function isValue($reader){
                                if ($reader->nodeType == XMLReader::TEXT){
                                    return true;
                                }
                                else{
                                    return false;
                                }
                            }

                            Private function isElement($reader){
                                if ($reader->nodeType == XMLREADER::ELEMENT){
                                    return true;
                                }else{
                                    return false;
                                }
                            }

                            Private function returnValue($reader){
                                if ($reader->nodeType == XMLReader::TEXT){
                                    return $reader->value;
                                }
                            }
                            Private function returnElement($reader){
                                if ($reader->nodeType == XMLREADER::ELEMENT){
                                    return $reader->localName;
                                }
                            }

}




    
