@extends('adminlte::page')

@section('title', 'Magistrados')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-gavel"> Detalle Magistradas y Magistrados del Tribunal de Justicia Electoral del Estado de Zacatecas </i></h1></font>
@stop

@section('content')

  
                
                <div class="card"> 
                   @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                   @endif
                   <div class="card-header">{{ $magistrado->primerapellido}} {{ $magistrado->segundoapellido}}, {{ $magistrado->nombre}}</div>
                    <div class="card-body" >
                         <p>Nombre: {{ $magistrado->nombre}}</p>
                         <p>Primer Apellido: {{ $magistrado->primerapellido}}</p>
                         <p>Segundo Apellido: {{ $magistrado->segundoapellido}}</p>
                         @if($magistrado->activo==0)
                                                <p>Estátus: <span class="badge badge-secondary">Inactivo(a)</span></p>
                                                @endif
                                                @if($magistrado->activo==1)
                                                <p>Estátus: <span class="badge badge-success">Activo(a)</span></p>
                                                @endif     
                    </div>                    
                    <div class="card-footer" align="right">    
                      <a href="{{ url('/magistrado/admin') }}" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a>        
                    </div>
                </div>
        

@endsection