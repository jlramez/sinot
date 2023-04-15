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
@section('title', 'Asignar roles')
@section('content_header')
    <h1>Asignar tareas a roles</h1>
@stop
@section('content')
<div class="card">
    <div class="card-header"><h3>{{ __('Asignar  rol a') }} {{$usuario->name}}</h3> </div>
            <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status')}}
                        </div>
                     @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('store_addrol', $usuario->id) }}">
                        @csrf

                        <div class="form-group row">
                            

                            <div class="">
                             <div>
                                    <h5>Asignar un rol</h5>
                             </div>
                                @foreach ($rsr as $rol)
                                <div>
                                    <label>
                                        <input name="roles_id[]" type="checkbox" id="{{ $rol->descripcion}}" value="{{ $rol->id }}" class="mr-1">{{ $rol->descripcion}}
                                    </labe>
                                </div>
                                @endforeach
                            </div>
                        </div>

                      
                        </div>

                        <div class="form-group row mb-0">
                            <div >
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i>
                                    {{ __('Asignar rol') }}
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