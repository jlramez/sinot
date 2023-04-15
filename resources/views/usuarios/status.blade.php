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

@section('title', 'Activar usuarios')

@section('content_header')
   
@stop

@section('content')

            <div class="card">
                <div class="card-header">{{ __('Activar/Desactivar Usuario') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                         @endif
                    <form method="POST" action="{{url('usuarios/activate/'.$usuario->id) }}">
                        @method('put')
                        @csrf

                        <div class="form-group ">
                            <label for="name">{{ __('Nombre del Usuario') }}</label>
                            <div class="">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                 name="name" value="{{ old('name', $usuario->name) }}" required autocomplete="name" autofocus disabled >

                                @error('name')
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
                      <a href="{{ url( 'usuarios/admin')}}"" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a>        
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
