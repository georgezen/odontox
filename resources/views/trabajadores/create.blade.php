@section('modal-add-contenido')

<form >

  <div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control','id'=>'nombre']) !!}
  </div>

  <!-- Apellido Pat Field -->
  <div class="form-group col-sm-6">
    {!! Form::label('apellido_pat', 'Apellido Pat:') !!}
    {!! Form::text('apellido_pat', null, ['class' => 'form-control','id'=>'apellido_pat']) !!}
  </div>

  <!-- Apellido Mat Field -->
  <div class="form-group col-sm-6">
    {!! Form::label('apellido_mat', 'Apellido Mat:') !!}
    {!! Form::text('apellido_mat', null, ['class' => 'form-control','id'=>'apellido_mat']) !!}
  </div>

  <!-- Fecha Nac Field -->
  <div class="form-group col-sm-6">
    {!! Form::label('fecha_nac', 'Fecha Nac:') !!}
    {!! Form::text('fecha_nac', null, ['class' => 'form-control','id' => 'datetimepicker2']) !!}
    
  </div>

  <div class="form-group col-sm-6">
    {!! Form::label('foto', 'Foto:') !!}
    {!! Form::text('foto', null, ['class' => 'form-control','id'=>'foto']) !!}
  </div>

  <div class="form-group col-sm-6">
    {!! Form::label('huella_digital', 'Huella digital:') !!}
    {!! Form::text('huella_digital', null, ['class' => 'form-control','id'=>'huella_digital']) !!}
  </div>

  <!-- Submit Field -->
  <div class="form-group col-sm-6">
    <input type="button" class="btn btn-success pull-left" id="save_trab" value="Guardar">
    
  </div>
</form>
@endsection
