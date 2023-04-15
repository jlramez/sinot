@extends('adminlte::page')

@section('title', 'Detalle áreas ')

@section('content_header')
<h1><i class="fas fa-location-arrow"> Detalle áreas del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1>
@stop

@section('content')

         
        <div class="card"> 

                   @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                   @endif
                   <div class="card-header">
                      <h3>{{ $area->descripcion}}</h3>
                  </div>
                    <div class="card-body" >
                         <p>Nombre: {{ $area->descripcion}}</p>
                         <p>Nomenclatura: {{ $area->nomenclatura}}</p>
                    </div>                    
                    <div class="card-footer" align="right">    
                           <a href="{{ url('/areas/admin') }}" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a>        
                    </div>
        </div>
@endsection
