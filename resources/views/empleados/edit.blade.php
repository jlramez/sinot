@extends('adminlte::page')

@section('title', 'Editar Empleados ')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-user-edit"> Editar Empleados(as) del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1></font>
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
                    <form method="POST" action="{{url('empleados/'.$empleado->id) }}">
                     @method('put')
                        @csrf

                        <div class="form-group ">
                            <label for="nombre">{{ __('Nombre del empleado') }}</label>
                            <div class="">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre', $empleado->nombre) }}" required autocomplete="nombre" autofocus>

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
                                <input id="ap" type="text" class="form-control @error('ap') is-invalid @enderror" 
                                name="ap" value="{{ old('ap', $empleado->ap) }}" required autocomplete="ap">

                                @error('ap')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group ">
                            <label for="am" >{{ __('Primer apellido') }}</label>

                            <div class="">
                                <input id="am" type="text" class="form-control @error('am') is-invalid @enderror" name="am" value="{{ old('am', $empleado->am) }}" required autocomplete="am">

                                @error('am')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="am" >{{ __('Magistrado(a) (Sí/No):') }}</label>

                            <div class="">
                                <input id="magistrado" type="text" class="form-control @error('magistrado') is-invalid @enderror" name="magistrado" value="{{ old('magistrado', $empleado->magistrado) }}" required autocomplete="magistrado">

                                @error('am')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                         <div class="form-group ">
                            <label for="am" >{{ __('CURP:') }}</label>

                            <div class="">
                                <input id="curp" type="text" class="form-control @error('curp') is-invalid @enderror" name="curp" value="{{ old('curp', $empleado->curp) }}" required autocomplete="curp">

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
                                <input id="rfc" type="text" class="form-control @error('rfc') is-invalid @enderror" name="rfc" value="{{ old('rfc', $empleado->rfc) }}" required autocomplete="rfc">

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
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $empleado->email) }}" required autocomplete="email">

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
                                    {{ __('Guardar Cambios') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer" align="right"> 
                      <a href="{{ url( 'empleados/admin')}}"" class="btn btn-dark" ><i class="fas fa-step-backward"></i>Regresar</a>
            </div> 
        </div>

@endsection
