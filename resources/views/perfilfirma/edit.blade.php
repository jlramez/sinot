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

@section('title', 'Roles de usuario')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-pen-alt"> Editar perfil de firmas del Tribunal de Justicia Electoral del Estado de Zacatecas </i></h1></font>  
@stop
@section('content')

            <div class="card">
                <div class="card-header">{{ __('Editar') }}</div>

                    <div class="card-body">
                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status')}}
                        </div>
                     @endif
                    <form method="POST" action="{{url('perfilfirma/'.$perfilfirma->id) }}">
                     @method('put')
                        @csrf

                        <div class="form-group ">
                            <label for="descripcion">{{ __('Nombre del Perfil de firma') }}</label>
                            <div class="">
                                <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror"
                                 name="descripcion" value="{{ old('descripcion', $perfilfirma->descripcion) }}" required autocomplete="descripcion" autofocus>

                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Guardar Cambios') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer" align="right"> 
                      <a href="{{ url( 'perfilfirmas/admin')}}"" class="btn btn-dark" ><i class="fas fa-step-backward"></i>Regresar</a> 
            </div>
        </div>
  
@endsection
