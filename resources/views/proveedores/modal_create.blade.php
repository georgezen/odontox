@section('modal-add-contenido')
{{ Form::open(array('id' =>'form_proveedor')) }}
<div class="row">
	<div class="form-group col-sm-4">
		{!! Form::label('nombre', 'Nombre:') !!}
		{!! Form::text('nombre', null, ['class' => 'form-control','id' => 'nombre']) !!}
	</div>

	<div class="form-group col-sm-4">
		{!! Form::label('ape_paterno', 'Apellido Paterno:') !!}
		{!! Form::text('ape_paterno', null, ['class' => 'form-control','id' => 'ape_paterno']) !!}
	</div>

	<div class="form-group col-sm-4">
		{!! Form::label('ape_materno', 'Apellido Materno:') !!}
		{!! Form::text('ape_materno', null, ['class' => 'form-control','id' => 'ape_materno']) !!}
	</div>
</div>

<div class="row">
	<div class="form-group col-sm-4">
		{!! Form::label('telefono', 'Teléfono:') !!}
		{!! Form::text('telefono', null, ['class' => 'form-control','id' => 'telefono']) !!}
	</div>

	<div class="form-group col-sm-4">
		{!! Form::label('Calle', 'Calle:') !!}
		{!! Form::text('calle', null, ['class' => 'form-control','id' => 'calle']) !!}
	</div>

	<div class="form-group col-sm-4">
		{!! Form::label('Colonia', 'Colonia:') !!}
		{!! Form::text('colonia', null, ['class' => 'form-control','id' => 'colonia']) !!}
	</div>

</div>

<div class="row">
	<div class="form-group col-sm-2">
		{!! Form::label('num_exterior', 'Número:') !!}
		{!! Form::text('num_exterior', null, ['class' => 'form-control','id' => 'num_exterior']) !!}
	</div>

	<div class="form-group col-sm-4">
		{!! Form::label('municipio', 'Municipio:') !!}
		{!! Form::text('municipio', null, ['class' => 'form-control','id' => 'municipio']) !!}
	</div>

	<div class="form-group col-sm-4">
		{!! Form::label('estado', 'Estado:') !!}
		{!! Form::text('estado', null, ['class' => 'form-control','id' => 'estado']) !!}
	</div>

	<div class="form-group col-sm-2">
		{!! Form::label('Pais', 'Pais:') !!}
		{!! Form::text('pais', null, ['class' => 'form-control','id' => 'pais']) !!}
	</div>

</div>



<!-- Submit Field -->
<div class="row">
	<div class="form-group col-sm-12">
		{!! Form::submit('Guardar', ['class' => 'btn btn-success','id' => 'save_proveedor']) !!}

	</div>

</div>


{{ Form::close() }}
@endsection