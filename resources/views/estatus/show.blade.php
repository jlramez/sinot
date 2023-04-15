@extends('adminlte::page')

@section('title', 'Estátus')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-check-square"> Detalle de estátus  de  estado que guardan los  expedientes dentro del Notrijez</i></h1></font>
@stop

@section('content')
    <div class="card">  
    @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                   @endif      
                <div class="card-header">
                     Detalle
                </div>
                
                  
                    <div class="card-body" >
                         <p>Nombre: {{ $estatus->descripcion}}</p>
                    </div>                    
                    <div class="card-footer" align="right">    
                      <a href="{{ url('/estatus/admin') }}" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a>        
                    </div>
                </div>
            

@endsection