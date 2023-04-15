@extends('adminlte::page')

@section('title', 'Detalle certificación ')

@section('content_header')
<h1><i class="fas fa-location-arrow"> Detalle certificación del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1>
@stop

@section('content')

         
        <div class="card"> 

                   @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                   @endif
                   <div class="card-header">
                      <h3>Certificación</h3>
                  </div>
                    <div class="card-body" >
                    <h4>
                         <p><b>Expediente:</b> {{ $certificacion->asigna_actuaciones->folio}}</p>
                         <p><b>Nombre del documento:</b> <span class="badge badge-secondary">{{ $certificacion->nombre_dcto}}</span></a></p>
                         <p><b>Fojas:</b> {{ $certificacion->fojas}}</p>
                         <p><b>Estatus:</b> 
                         @if($certificacion->estatus==1)
                                                <td>
                                                <span class="badge badge-success">Aceptado</span>                                                           
                                                </td>
                                                @endif
                                                @if($certificacion->estatus==0)
                                                <td>
                                                <span class="badge badge-danger">Rechazado</span>                                                           
                                                </td>
                                                @endif</p>
                         <p><b>Certificado:</b>
                           @if($certificacion->firmada==1)
                           <span class="badge badge-success">Certificado</span></a>
                           @endif
                           @if($certificacion->firmada==0)
                           <span class="badge badge-warning">Por certificar</span></a>
                           @endif</p>
                    </h4>
                    </div>                    
                    <div class="card-footer" align="right">    
                           <a href="{{ url('/certificacion/admin') }}" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a>        
                    </div>
        </div>
@endsection
