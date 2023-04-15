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


@section('title', 'Asignar tareas')

@section('content_header')
    <h1>Asignar tareas a roles</h1>

@section('content')
<div class="card">
    <div class="card-header"><h3>{{ __('Agregar firmantes a perfil de firma') }} <b>{{$perfilfirma->descripcion}}</b></h3> </div>
            <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status')}}
                        </div>
                     @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('store_addsign', $perfilfirma->id) }}">
                        @csrf

                        <div class="form-group row">
                            

                            <div class="">
                             <div>
                                    <h5>Listado de empleados con permiso de firma</h5>
                             </div>
                                @foreach ($rse as $empleado)
                                <div>
                                    <label>
                                        <input name="empleados_id[]" type="checkbox" id="{{ $empleado->nombre}}" value="{{ $empleado->id }}" class="mr-1">{{ $empleado->nombre}} {{ $empleado->ap}} {{ $empleado->am}}     -     {{ $empleado->puestos->descripcion}}
                                    </labe>
                                </div>
                                @endforeach
                            </div>
                        </div>

                      
                        </div>

                        <div class="form-group row mb-0">
                            <div >
                                <button type="submit" class="btn btn-dark"><i class="fas fa-check-circle"></i>
                                    {{ __('Asignar Firmante') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection