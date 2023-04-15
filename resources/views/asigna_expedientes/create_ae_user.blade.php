
	 <!-- Jquery -->
     <script src="/js/jquery-1.11.3.min.js"></script>
    <!-- Scripts -->
    
    
    <!-- Stylesheet -->
	<link href="/css/bootstrap-tagsinput.css" rel="stylesheet" type="text/css">
	<!-- JavaScript -->
	<script src="/js/bootstrap-tagsinput.js"></script>
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


@section('title', 'Asignar expedientes')

@section('content_header')
    <h1>Asignar expedentes a usuarios</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header"><h>{{ __('Agregar Expediente a usuario ') }} </h3> </div>
            <div class="card-body">
            @if (session('status'))
                    @if (session('type'))
                            <div class="{{session('type')}}" role="alert">
                                {{ session('status')}}
                            </div>

                    @endif
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('store_addexp', $usuario->id) }}">
                        @csrf
                        <div class="form-group ">
                            <label for="user_id" >{{ __('Usuario:') }}</label>

                            <div class="">
                                <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name',$usuario->name) }}" required autocomplete="user_name" >
                                <input id="users_id" type="hidden" class="form-control @error('users_id') is-invalid @enderror" name="users_id" value="{{ old('user_id',$usuario->id) }}" required autocomplete="users_id" >
                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="add_exp" >{{ __('Expedientes asignados:') }}</label>

                            <div class="">
                                @foreach($rsae as $expediente)
                                    <span class="badge badge-info"><i class="fas fa-folder">{{$expediente->expedientes->folio}}</i></span> 
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="expedientes_folio" >{{ __('Agregar Expedientes:') }}</label>

                            <div class="">
                            <input type="text" data-role="tagsinput" name="expedientes_folio" class="form-control" id="expedientes_folio" value="{{ old('expedientes_folio') }}">   
                                @error('expedientes_folio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group  mb-5">
                            <div >
                                <button type="submit" class="btn btn-dark"><i class="fas fa-check-circle"></i>
                                    {{ __('Asignar Expediente') }}
                                </button>
                            </div>
                        </div>
                    </form>

    <script>
        $(document).ready(function(){
            $('#add_exp').keyup(function(e){
                var str = $('#add_exp').val();
                str = str.replace(/\W+(?!$)/g, '-').toLowerCase();//rplace stapces with dash
                $('#add_exp').val(str);
                $('#add_exp').attr('placeholder', str);
            });
        });
        
    </script>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('css_role_page')
    <link rel="stylesheet" href="/css/bootstrap-tagsinput.css">
@endsection

@section('js_role_page')
    <script src="/js/bootstrap-tagsinput.js"></script>

    <script>
        $(document).ready(function(){
            $('#role_name').keyup(function(e){
                var str = $('#role_name').val();
                str = str.replace(/\W+(?!$)/g, '-').toLowerCase();//rplace stapces with dash
                $('#role_slug').val(str);
                $('#role_slug').attr('placeholder', str);
            });
        });
        
    </script>

@endsection
