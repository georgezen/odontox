@section('modal-edit-contenido')
 {{ Form::open(array('id' =>'form_cliente_edit')) }}
 <input type="hidden" name="id_cliente_upd" value="" id="id_cli_u">
 <div class="row">
  <div class="form-group col-sm-4">
    {!! Form::label('Nombre', 'Nombre:') !!}
    {!! Form::text('nombre_edit', null, ['class' => 'form-control','id' => 'nombre_edit']) !!}
  </div>

  <div class="form-group col-sm-4">
    {!! Form::label('ape_paterno', 'Apellido Paterno:') !!}
    {!! Form::text('ape_paterno_edit', null, ['class' => 'form-control ape_paterno','id' => 'ape_paterno_edit']) !!}
  </div>

  <div class="form-group col-sm-4">
    {!! Form::label('ape_materno', 'Apellido Materno:') !!}
    {!! Form::text('ape_materno_edit', null, ['class' => 'form-control ape_materno','id' => 'ape_materno_edit']) !!}
  </div>

</div>

<div class="row">
  <div class="form-group col-sm-4">
    {!! Form::label('edad', 'Edad:') !!}
    {!! Form::text('edad_edit', null, ['class' => 'form-control edad','id' => 'edad_edit']) !!}
  </div>

  <div class="form-group col-sm-4">
    {!! Form::label('telefono', 'Télefono:') !!}
    {!! Form::text('telefono_edit', null, ['class' => 'form-control telefono','id' => 'telefono_edit']) !!}
  </div>

  <div class="form-group col-sm-4">
    {!! Form::label('calle', 'Calle:') !!}
    {!! Form::text('calle_edit', null, ['class' => 'form-control calle','id' => 'calle_edit']) !!}
  </div>

</div>

<div class="row">
  <div class="form-group col-sm-4">
    {!! Form::label('no_ext', 'No.') !!}
    {!! Form::text('num_exterior_edit', null, ['class' => 'form-control num_exterior','id' => 'num_exterior_edit']) !!}
  </div>

  <div class="form-group col-sm-4">
    {!! Form::label('colonia', 'Colonia:') !!}
    {!! Form::text('colonia_edit', null, ['class' => 'form-control colonia','id' => 'colonia_edit']) !!}
  </div>

  <div class="form-group col-sm-4">
    {!! Form::label('ciudad', 'Ciudad:') !!}
    {!! Form::text('ciudad_edit', null, ['class' => 'form-control ciudad','id' => 'ciudad_edit']) !!}
  </div>

</div>

<div class="row">
  <div class="form-group col-sm-4">
    {!! Form::label('estado', 'Estado') !!}
    {!! Form::text('estado_edit', null, ['class' => 'form-control estado','id' => 'estado_edit']) !!}
  </div>

  <div class="form-group col-sm-4">
    {!! Form::label('pais', 'Pais:') !!}
    {!! Form::text('pais_edit', null, ['class' => 'form-control pais','id' => 'pais_edit']) !!}
  </div>

  <div class="form-group col-sm-4">
    
  </div>

</div>



<!-- Submit Field -->
<div class="row">
  <div class="form-group col-sm-12">
    {!! Form::submit('Actualizar', ['class' => 'btn btn-success','id' => 'update_cliente']) !!}

  </div>

</div>


{{ Form::close() }}
@endsection