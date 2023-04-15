
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

@section('title', 'Editar Magistrados')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-gavel"> Editar Magistradas y Magistrados del Tribunal de Justicia Electoral del Estado de Zacatecas </i></h1></font>
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
                    <form method="POST" action="{{url('magistrado/'.$magistrado->id) }}">
                    @method('put')
                        @csrf

                        <div class="form-group ">
                            <label for="descripción" >{{ __('Nombre') }}</label>

                            <div >
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre', $magistrado->nombre) }}" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    <div class="form-group ">
                        <label for="primerapellido" >{{ __('Primer Apellido') }}</label>

                        <div>
                                <input id="primerapellido" type="text" class="form-control @error('primerapellido') is-invalid @enderror" name="primerapellido" value="{{ old('primerapellido', $magistrado->primerapellido) }}" required autocomplete="primerapellido" autofocus>

                                @error('primerapellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="segundoapellido" >{{ __('Segundo  Apellido') }}</label>

                        <div >
                                <input id="segundoapellido" type="text" class="form-control @error('segundoapellido') is-invalid @enderror" name="segundoapellido" value="{{ old('segundoapellido', $magistrado->segundoapellido) }}" required autocomplete="segundoapellido" autofocus>

                                @error('segundoapellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>

                    <div class="form-group ">
                            <label for="activo" >{{ __('Activo:') }}</label>

                            <div >
                                  <select name="activo" id="activo" class="form-control">
                                    
                                      <option value="0">No</option>
                                      <option value="1">Si</option>
                                                                   
                                </select> 
                                @error('activo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark"><i class="fas fa-check-circle"></i>
                                    {{ __('Guardar Cambios') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer" align="right"> 
                      <!--<a href="{{ url( 'expedientes/admin')}}"" class="btn btn-danger" ><i class="fas fa-file-pdf"></i>Adjuntar </a>   
                      <a href="{{ url( 'expedientes/admin')}}"" class="btn btn-primary" ><i class="fas fa-file-word"></i>Adjuntar </a> --> 
                      <a href="{{ url( 'magistrado/admin')}}"" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a>        
            </div>
        </div>
   
@endsection