@extends('adminlte::page')

@section('title', 'Detalle Usuarios')

@section('content_header')
    <h1>Detalle de usuario {{$user->name}}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
                <h3>Name: {{ $user->name }}</h3>
                <h3>Email: {{ $user->email }}</h3>

        </div>
        <div class="card-body">
            <h5 class="card-title">Role</h5>
            <p class="card-text"></p>
            <h5 class="card-title">Permissions</h5>
            <p class="card-text"></p>
        </div>
        <div class="card-footer">
                <a href=" {{ url()->previous() }} " class="btn btn-primary">Regresar <-</a>
        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script>
Swal.fire(
  'The Internet?',
  'That thing is still around?',
  'question'
)
</script>
@stop