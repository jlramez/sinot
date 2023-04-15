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
@stop

@section('content_header')
@stop

@section('content')
<div class="card">
    <div class="card-header"><h3>{{ __('Agregar Expediente a usuario') }} </h3> </div>
            <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status')}}
                        </div>
                     @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('store_addexp', $usuario->id) }}">
                        @csrf
                        <div class="form-group ">
                            <label for="ponencia_id" >{{ __('Usuario:') }}</label>

                            <div class="">
                           
                                  <select name="users_id" id="users_id" class="form-control" required>
                                  <option value="">--Seleccione un usuario--</option> 
                                    @foreach ($rsu as $usuario)
                                   
                                      <option value="{{$usuario->id}}" name="users_id">{{$usuario->name}}</option>
                                     @endforeach
                                </select> 
                            </div>

                        <div class="form-group mt-4 ">                        
                            <div class="">                               
                                <label for="ponencia_id" >{{ __('Listado de expedientes:') }}</label>                                  
                                    @foreach ($rse as $expediente)                                                                     
                                      @foreach ($rsae as $ae)       
                                        <div >
                                            @if($expediente->id==$ae->expedientes_id)
                                            <input name="expedientes_id[]" type="checkbox" id="{{ $expediente->folio}}"  value="{{ $expediente->id }}" class="form-check-input" checked >{{ $expediente->folio}}    
                                                @if($expediente->id!=$ae->expedientes_id)
                                                    <input name="expedientes_id[]" type="checkbox" id="{{ $expediente->folio}}"  value="{{ $expediente->id }}" class="form-check-input" >{{ $expediente->folio}}    
                                                @endif                                                    
                                            @endif
                                        </div>                                         
                                                
                                        @endforeach  
                                    @endforeach                               
                            </div>
                        </div>

                      
                        </div>

                        <div class="form-group  mb-0">
                            <div >
                                <button type="submit" class="btn btn-dark"><i class="fas fa-check-circle"></i>
                                    {{ __('Asignar Expediente') }}
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