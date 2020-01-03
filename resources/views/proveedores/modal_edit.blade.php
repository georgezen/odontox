@section('modal-edit-contenido')
{{ Form::open(array('id' =>'form_edit_proveedor')) }}
<input type="hidden" name="id_update_prov" id="id_update_prov" value="">
<div class="row">
	<div class="form-group col-sm-4">
		{!! Form::label('nombre', 'Nombre:') !!}
		{!! Form::text('nombre', null, ['class' => 'form-control','id' => 'nombre_prov']) !!}
	</div>

	<div class="form-group col-sm-4">
		{!! Form::label('ape_paterno', 'Apellido Paterno:') !!}
		{!! Form::text('ape_paterno', null, ['class' => 'form-control','id' => 'ape_paterno_prov']) !!}
	</div>

	<div class="form-group col-sm-4">
		{!! Form::label('ape_materno', 'Apellido Materno:') !!}
		{!! Form::text('ape_materno', null, ['class' => 'form-control','id' => 'ape_materno_prov']) !!}
	</div>
</div>

<div class="row">
	<div class="form-group col-sm-4">
		{!! Form::label('telefono', 'Teléfono:') !!}
		{!! Form::text('telefono', null, ['class' => 'form-control','id' => 'telefono_prov']) !!}
	</div>

	<div class="form-group col-sm-4">
		{!! Form::label('Calle', 'Calle:') !!}
		{!! Form::text('calle', null, ['class' => 'form-control','id' => 'calle_prov']) !!}
	</div>

	<div class="form-group col-sm-4">
		{!! Form::label('Colonia', 'Colonia:') !!}
		{!! Form::text('colonia', null, ['class' => 'form-control','id' => 'colonia_prov']) !!}
	</div>

</div>

<div class="row">
	<div class="form-group col-sm-2">
		{!! Form::label('num_exterior', 'Número:') !!}
		{!! Form::text('num_exterior', null, ['class' => 'form-control','id' => 'num_exterior_prov']) !!}
	</div>

	<div class="form-group col-sm-4">
		{!! Form::label('municipio', 'Municipio:') !!}
		{!! Form::text('municipio', null, ['class' => 'form-control','id' => 'municipio_prov']) !!}
	</div>

	<div class="form-group col-sm-4">
		{!! Form::label('estado', 'Estado:') !!}
		{!! Form::text('estado', null, ['class' => 'form-control','id' => 'estado_prov']) !!}
	</div>

	<div class="form-group col-sm-2">
		{!! Form::label('Pais', 'Pais:') !!}
		{!! Form::text('pais', null, ['class' => 'form-control','id' => 'pais_prov']) !!}
	</div>

</div>



<!-- Submit Field -->
<div class="row">
	<div class="form-group col-sm-12">
		{!! Form::submit('Guardar', ['class' => 'btn btn-success','id' => 'update_proveedor']) !!}

	</div>

</div>


{{ Form::close() }}
@endsection