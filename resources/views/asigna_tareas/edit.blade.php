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

@section('title', 'Asigna Tareas')

@section('content_header') 
<h1><i class="fas fa-tasks"> Activar/Desactivar Tareas de los roles del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1>   
@stop
@section('content')


            <div class="card">
                <div class="card-header">{{ __('Activar / Desactivar') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                         @endif
                    <form method="POST" action="{{url('asigna_tareas/'.$at->id) }}">
                        @method('put')
                        @csrf

                        <div class="form-group ">
                            <label for="descripcion">{{ __('Nombre de la Tarea') }}</label>
                            <div class="">
                                <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror"
                                 name="descripcion" value="{{ old('descripcion', $at->tareas->descripcion) }}" required autocomplete="descripcion" autofocus disabled>

                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group " >
                            <div class="col-md-6 offset-md-4" >
                                <button type="submit" class="btn btn-dark"><i class="fas fa-power-off"></i>
                                    {{ __('Activar/Desactivar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer" align="right">     
                      <a href="{{ url( '/asigna_tareas/'.$at->roles_id.'/show')}}"" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a>        
                    </div>
            </div>
    
@endsection
