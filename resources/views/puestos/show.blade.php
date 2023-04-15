@extends('adminlte::page')

@section('title', 'Detalle Puestos')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-vote-yea"> Detalle Puestos del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1></font>
@stop
@blade
@section('content')

   
               
                <div class="card"> 
                   @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                   @endif
                    <div class="card-body" >
                         <p>Nombre: {{ $puesto->descripcion}}</p>
                         <p>Nomenclatura: {{ $puesto->nomenclatura}}</p>
                         <p>Área/Procedencia: {{$puesto->areas->descripcion}} </p>
                        
                    </div>                    
                    <div class="card-footer" align="right">    
                      <a href="{{ url('/puestos/admin') }}" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a>        
                    </div>
                </div>
        

@endsection