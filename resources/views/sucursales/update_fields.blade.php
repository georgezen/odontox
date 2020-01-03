<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
    {!! Form::text('id_sucursal', $sucursales->id, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('Save', ['class' => 'btn btn-success','id'=>'update_sucursal']) !!}
    <a href="{!! route('sucursales.index') !!}" class="btn btn-default">Cancel</a>
</div>
