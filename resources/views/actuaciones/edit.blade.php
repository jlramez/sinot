<style>
      textarea:focus, input:focus, input[type]:focus 
      {
            border-color: rgb(54, 112, 104);
            box-shadow: 0 1px 1px rgba(54, 112, 104, 0.075)inset, 0 0 8px rgba(54, 112, 104,0.6);
            outline: 0 none;

       }
    
       option:hover {
         background:green
        }
       

  </style>
@extends('adminlte::page')

@section('title', 'Editar actuación')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-address-book">Editar actuación para  expedientes dentro del Notrijez</i></h1></font>
@stop

@section('content')
            <div class="card">
                <div class="card-header">{{ __('Editar ') }}</div>
                    <div class="card-body">
                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status')}}
                        </div>
                     @endif
                <div class="card-body">
                    <form method="POST" action="{{url('actuacion/'.$actuacion->id) }}">
                    @method('put')
                        @csrf

                        <div class="form-group ">
                            <label for="Nombre">{{ __('Nombre de la actuación') }}</label>
                            <div class="col-md-6">
                                <input id="Nombre" type="text" class="form-control @error('Nombre') is-invalid @enderror"
                                 name="Nombre" value="{{ old('Nombre', $actuacion->Nombre) }}" required autocomplete="Nombre" autofocus required>

                                @error('Nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark"><i class="fas fa-check-circle"></i>
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer" align="right"> 
                      <!--<a href="{{ url( 'expedientes/admin')}}"" class="btn btn-danger" ><i class="fas fa-file-pdf"></i>Adjuntar </a>   
                      <a href="{{ url( 'expedientes/admin')}}"" class="btn btn-primary" ><i class="fas fa-file-word"></i>Adjuntar </a> --> 
                      <a href="{{ url( 'actuacion/admin')}}"" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a>        
            </div>
        </div>
 
@endsection