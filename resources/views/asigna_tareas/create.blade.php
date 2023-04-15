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
    <div class="card-header"><h3>{{ __('Agregar Tareas a rol') }} {{$roles->descripcion}}</h3> </div>
            <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status')}}
                        </div>
                     @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('store_addtask', $roles->id) }}">
                        @csrf

                        <div class="form-group row">
                            

                            <div class="">
                             <div>
                                    <h5>Listado de tareas</h5>
                             </div>
                                @foreach ($rst as $tarea)
                                <div>
                                    <label>
                                        <input name="tareas_id[]" type="checkbox" id="{{ $tarea->descripcion}}" value="{{ $tarea->id }}" class="mr-1">{{ $tarea->descripcion}}
                                    </labe>
                                </div>
                                @endforeach
                            </div>
                        </div>

                      
                        </div>

                        <div class="form-group row mb-0">
                            <div >
                                <button type="submit" class="btn btn-dark"><i class="fas fa-check-circle"></i>
                                    {{ __('Asignar Tarea') }}
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