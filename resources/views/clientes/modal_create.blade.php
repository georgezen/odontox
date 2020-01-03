@section('modal-add-contenido')
 {{ Form::open(array('id' =>'form_cliente')) }}
 <div class="row">
  <div class="form-group col-sm-4">
    {!! Form::label('Nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control','id' => 'nombre']) !!}
  </div>

  <div class="form-group col-sm-4">
    {!! Form::label('ape_paterno', 'Apellido Paterno:') !!}
    {!! Form::text('ape_paterno', null, ['class' => 'form-control ape_paterno','id' => 'ape_paterno']) !!}
  </div>

  <div class="form-group col-sm-4">
    {!! Form::label('ape_materno', 'Apellido Materno:') !!}
    {!! Form::text('ape_materno', null, ['class' => 'form-control ape_materno','id' => 'ape_materno']) !!}
  </div>

</div>

<div class="row">
  <div class="form-group col-sm-4">
    {!! Form::label('edad', 'Edad:') !!}
    {!! Form::text('edad', null, ['class' => 'form-control edad','id' => 'edad']) !!}
  </div>

  <div class="form-group col-sm-4">
    {!! Form::label('telefono', 'Télefono:') !!}
    {!! Form::text('telefono', null, ['class' => 'form-control telefono','id' => 'telefono']) !!}
  </div>

  <div class="form-group col-sm-4">
    {!! Form::label('calle', 'Calle:') !!}
    {!! Form::text('calle', null, ['class' => 'form-control calle','id' => 'calle']) !!}
  </div>

</div>

<div class="row">
  <div class="form-group col-sm-4">
    {!! Form::label('no_ext', 'No.') !!}
    {!! Form::text('num_exterior', null, ['class' => 'form-control num_exterior','id' => 'num_exterior']) !!}
  </div>

  <div class="form-group col-sm-4">
    {!! Form::label('colonia', 'Colonia:') !!}
    {!! Form::text('colonia', null, ['class' => 'form-control colonia','id' => 'colonia']) !!}
  </div>

  <div class="form-group col-sm-4">
    {!! Form::label('ciudad', 'Ciudad:') !!}
    {!! Form::text('ciudad', null, ['class' => 'form-control ciudad','id' => 'ciudad']) !!}
  </div>

</div>

<div class="row">
  <div class="form-group col-sm-4">
    {!! Form::label('estado', 'Estado') !!}
    {!! Form::text('estado', null, ['class' => 'form-control estado','id' => 'estado']) !!}
  </div>

  <div class="form-group col-sm-4">
    {!! Form::label('pais', 'Pais:') !!}
    {!! Form::text('pais', null, ['class' => 'form-control pais','id' => 'pais']) !!}
  </div>

  <div class="form-group col-sm-4">
    
  </div>

</div>



<!-- Submit Field -->
<div class="row">
  <div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-success','id' => 'save_cliente']) !!}

  </div>

</div>


{{ Form::close() }}
@endsection