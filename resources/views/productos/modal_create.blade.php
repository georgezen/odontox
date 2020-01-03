@section('modal-add-contenido')
 {{ Form::open(array('id' =>'form_producto')) }}
 <div class="row">
  <div class="form-group col-sm-6">
    {!! Form::label('codigo', 'Código:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control','id' => 'codigo']) !!}
  </div>

  <div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control','id' => 'nombre']) !!}
  </div>

</div>

<div class="row">
  <div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripción:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control','id' => 'descripcion']) !!}
  </div>

  <div class="form-group col-sm-6">
  
  </div>

</div>



<!-- Submit Field -->
<div class="row">
  <div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-success','id' => 'save_producto']) !!}

  </div>

</div>


{{ Form::close() }}
@endsection