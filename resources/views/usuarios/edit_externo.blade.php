<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

@section('title', 'Agregar Usuarios Externos')

@section('content_header')
 

            <div class="card">
                <div class="card-header">{{ __('Registrar Usuarios Externos') }}</div>

                <div class="card-body">
                @if (session('status'))
                
                    @if (session('type'))
                    <script>
                     Swal.fire(
                                "{{session('status')}}",
                                'Presione Ok, para continuar',
                                "{{session('type')}}"
                                )
                     </script>                   
                           <!-- <div class="{{session('type')}}" role="alert">
                                {{ session('status')}}
                            </div>-->

                    @endif
                @endif
                    <form method="POST" action="{{ route('update_usuario_externo_expediente', $expediente->id) }}">
                        @csrf
                        @method('put')
                                                              
                                               
                            <div class="form-group ">
                                <label for="name" >{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                               
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $expediente->actor ) }}" required autocomplete="name" autofocus>
                               
                              
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="curp" >{{ __('CURP') }}</label>

                                <div class="col-md-6">
                                  @if($curp)
                                    <input id="curp" type="text" class="form-control @error('curp') is-invalid @enderror" name="curp" value="{{ old('curp', $curp) }}"required autocomplete="curp" autofocus>
                                  @endif  
                                  @if(!$curp)
                                  <input id="curp" type="text" class="form-control @error('curp') is-invalid @enderror" name="curp" required autocomplete="curp" autofocus>
                                  @endif 
                                    @error('curp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="form-group ">
                            <label for="expediente" >{{ __('Expediente') }}</label>
                                <div class="col-md-6">
                              
                                    <input id="expediente" type="text" class="form-control @error('expediente') is-invalid @enderror" name="expediente" value="{{ old('expediente', $expediente->folio) }}" required autocomplete="expediente" autofocus>
                               
                                
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                       <!-- <div class="form-group row">
                            <label for="user" class="col-md-4 col-form-label text-md-right">{{ __('Usuario') }}</label>

                            <div class="col-md-6">
                                <input id="user" type="user" class="form-control @error('user') is-invalid @enderror" name="user" value="{{ old('user', $user_full) }}" required autocomplete="user">

                                @error('user')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>-->
                            <div class="form-group ">
                                <label for="email" >{{ __('Usuario') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user_full) }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>                 
                        
                        
                
                        <div class="form-group">
                            <label for="password" >{{ __('Password') }}</label>

                            <div class="col-md-6">
                          
                                <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password', $password) }}"  required autocomplete="new-password">
                           
                          
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group" >
                            <label for="password-confirm" >{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                          
                                <input id="password-confirm" type="text" class="form-control" name="password_confirmation" value="{{ old('password_confirmation', $password) }}" required autocomplete="new-password">
                           
                           
                            </div>
                        </div>

                        <div class="form-group ">
                                <label for="email_notificacion" ><font color="red">{{ __('Correo electrónico personal **') }}</font></label>

                                <div class="col-md-6">
                                    <input id="email_notificacion" type="email" class="form-control @error('email') is-invalid @enderror" name="email_notificacion" value="{{ old('email_notificacion') }}" required autocomplete="email_notificacion">

                                    @error('email_notificacion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>  
                    
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer" align="right">                
                        <!--<a href="{{ url('/addexp/create/'.$expediente->users_id)}}" class="btn btn-dark" ><i class="fas fa-folder-plus"></i>Asignar expediente</a>  -->                   
                        <a href="{{ url( 'usuarios/admin')}}" class="btn btn-dark" ><i class="fas fa-check-circle"></i>Regresar</a>                      
                       
            </div>
            ** Necesario para notificación por correo electrónico
        </div>
    
@endsection
