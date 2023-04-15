
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
@if(Session::has('status'))
	@section('scripts')

		<script>
			Swal.fire('la Información se guardo correctamente');
			
		</script>
	@endsection	
	{{-- <div class="alert alert-primary" role="alert">
		<button type="button" class="close" data-dismiss="alert"> &times; </button>
		{{ Session::get('status') }}

	</div> --}}

@endif

@if(count($errors))

			@foreach($errors->all() as $error) 
				
				@section('scripts')
						<script>
							var error = @json($error);
							Swal.fire({
								type:'error',
								title: 'Falta informacion',
								text: error,

							});



							
						</script>
				@endsection	
			
			@endforeach

@endif