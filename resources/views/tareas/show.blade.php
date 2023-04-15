@extends('adminlte::page')

@section('title', 'Tareas')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-tasks"> Detalle Tareas existentes para  roles dentro del Notrijez </i></h1></font>
@stop

@section('content')

    
                <h3>{{ $tarea->descripcion}}</h3>
                <div class="card"> 
                   @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                   @endif
                    <div class="card-body" >
                         <p>Nombre: {{ $tarea->descripcion}}</p>
                    </div>                    
                    <div class="card-footer" align="right">    
                      <a href="{{ url('/tareas/admin') }}" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a>        
                    </div>
                </div>
          

@endsection