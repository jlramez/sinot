@extends('adminlte::page')

@section('title', 'Agregar Empleados ')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-user-plus"> Agregar Empleados </i><h1></font>
@stop

@section('content')

            <div class="card">
                <div class="card-header">{{ __('Nuevo Empleado') }}</div>

                    <div class="card-body">
                     @if (session('status'))
                        <div class="alert alert-success" role="alert" >
                            {{ session('status')}}
                        </div>
                     @endif
                    <form method="POST" action="{{route('store_empleado') }}">
                        @csrf

                        <div class="form-group " columnsize="md">
                            <label for="nombre">{{ __('Nombre del empleado') }}</label>
                            <div class="">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="ap" >{{ __('Primer apellido') }}</label>

                            <div class="">
                                <input id="ap" type="text" class="form-control @error('ap') is-invalid @enderror" name="ap" value="{{ old('ap') }}" required autocomplete="ap">

                                @error('ap')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group ">
                            <label for="am" >{{ __('Segundo apellido') }}</label>

                            <div class="">
                                <input id="am" type="text" class="form-control @error('am') is-invalid @enderror" name="am" value="{{ old('am') }}" required autocomplete="am">

                                @error('am')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="magistrado" >{{ __('Magistrado(a):') }}</label>

                            <div >
                                  <select name="magistrado" id="Magistrado" class="form-control">
                                    
                                      <option value="0">No</option>
                                      <option value="1">Si</option>
                                                                   
                                </select> 
                                @error('magistrado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                         <div class="form-group ">
                            <label for="am" >{{ __('CURP:') }}</label>

                            <div class="">
                                <input id="curp" type="text" class="form-control @error('curp') is-invalid @enderror" name="curp" value="{{ old('curp') }}" required autocomplete="curp">

                                @error('curp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                         <div class="form-group ">
                            <label for="am" >{{ __('RFC') }}</label>

                            <div class="">
                                <input id="rfc" type="text" class="form-control @error('rfc') is-invalid @enderror" name="rfc" value="{{ old('rfc') }}" required autocomplete="rfc">

                                @error('rfc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="am" >{{ __('Puesto:') }}</label>

                            <div class="">
                                  <select name="puestos_id" id="puestos_id" class="form-control">
                                    @foreach ($rsp as $puesto) 
                                      <option value="{{ $puesto->id }}">{{ $puesto->descripcion }}</option>
                                     @endforeach
                                </select> 
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="am" >{{ __('Correo electrónico:') }}</label>

                            <div class="">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Guardar ') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer" align="right"> 
                      <a href="{{ url( 'empleados/admin')}}"" class="btn btn-dark" ><i class="fas fa-chevron-circle-left"></i>    Regresar</a> 
        </div>
    </div>
@endsection
