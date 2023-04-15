
@extends('adminlte::page')

@section('title', 'Detalle Ponencias')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-briefcase"> Detalle ponencia del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1></font>
@stop

@section('content')
    
                <h3>{{ $ponencia->descripcion}}</h3>
                <div class="card"> 
                   @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                   @endif
                    <div class="card-body" >
                         <p>Ponencia: {{ $ponencia->descripcion}}</p>
                         <p>Magistrado(a) insructor: {{ $magistrado[0]->nombre}} {{ $magistrado[0]->primerapellido}} {{ $magistrado[0]->segundoapellido}}</p>    
                    </div>                    
                    <div class="card-footer" align="right">    
                      <a href="{{ url('/ponencia/admin') }}" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a>        
                    </div>
                </div>
        

@endsection