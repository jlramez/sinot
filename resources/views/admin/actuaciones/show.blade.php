@extends('adminlte::page')

@section('content')

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <h3>{{ $actuacion->Nombre}}</h3>
                <div class="card"> 
                   @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                   @endif
                    <div class="card-body" >
                         <p>Nombre: {{ $actuacion->Nombre}}</p>
                    </div>                    
                    <div class="card-footer" align="right">    
                      <a href="{{ url('/actuacion/admin') }}" class="btn btn-success" ><i class="fas fa-check-circle"></i>Aceptar</a>        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection