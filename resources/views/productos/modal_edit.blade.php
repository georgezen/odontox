@section('modal-edit-contenido')
{{ Form::open(array('id' =>'edit_producto_form')) }}
<input type="hidden" value="" name="id_pro_update" id="id_pro_update">
<div class="row">
  <div class="form-group col-sm-6">
    {!! Form::label('codigo', 'Código:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control','id' => 'edit_codigo']) !!}
  </div>

  <div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control','id' => 'edit_nombre']) !!}
  </div>

</div>

<div class="row">
  <div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripción:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control','id' => 'edit_descripcion']) !!}
  </div>

  <div class="form-group col-sm-6">
   
  </div>

</div>



<!-- Submit Field -->
<div class="row">
  <div class="form-group col-sm-12">
    {!! Form::button('Editar', ['class' => 'btn btn-success','id' => 'update_producto']) !!}

  </div>

</div>


{{ Form::close() }}
@endsection