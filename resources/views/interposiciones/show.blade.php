@extends('adminlte::page')

@section('title', 'Interposiciones')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-share-square">Mostrar interposiciones de los  expedientes dentro del Notrijez</i></h1></font>
@stop

@section('content')
              <div class="card-header">
                {{ $interposicion->descripcion }}
              </div>
                <div class="card"> 
                   @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                   @endif
                    <div class="card-body" >
                         <p>Nombre: {{ $interposicion->descripcion}}</p>
                    </div>                    
                    <div class="card-footer" align="right">    
                      <a href="{{ url('/interposicion/admin') }}" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a>        
                    </div>
                </div>
        

@endsection