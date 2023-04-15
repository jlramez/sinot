@extends('adminlte::page')

@section('title', ' Asigna actuaciones')

@section('content_header')
<h1><i class="fas fa-folder">Asignar actuaciones a expediente </i></h1>
@stop

@section('content')

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <h3>{{ $aa[0]->folio}}</h3>
                <div class="card"> 
                   @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                   @endif
                   
                    <div class="card-body" >
                    <h5><label>ID:</label></h5>
                         <p>{{ $id_asigna_actuacion}}</p>
                         <h5><label>Actuación:</label></h5>
                         <p>{{ $aa[0]->Nombre}}</p>
                         <h5><label>Expediente:</label></h5>
                         <p>{{ $aa[0]->folio}}</p>
                         <h5><label>Magistrado instructor:</label></h5>
                         <p>{{ $aa[0]->folio}}</p>
                         <h5><label>Autorizada:</label></h5>
                         @if($aa[0]->autorizada==1)
                            <p>Si</p>
                         @endif
                         @if($aa[0]->autorizada==0)
                            <p>No</p>
                         @endif 
                         <h5><label>Usuario que crea actuación:</label></h5>
                         <p>{{ $aa[0]->name}}</p>
                         <h5><label>Resumen actuación:</label></h5>
                         <p>{{ $aa[0]->resumen_actuacion}}</p> 
                         <h5><label>Archivos adjuntos:</label></h5>
                         <p>0<i class="fas fa-eye"></i>Ver archivo(s):</a></p>
                        
                    </div>                    
                    <div class="card-footer" align="right">
                   
                    <a href="{{ url('/asigna_actuaciones/'.$id_asigna_actuacion.'/edit') }}" class="btn btn-dark" ><i class="fas fa-edit"></i>Editar</a>    
                    <a href="{{ url('/asigna_actuaciones/'.$aa[0]->expedientes->id.'/show') }}" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a>         
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection