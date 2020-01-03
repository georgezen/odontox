<!-- Hora Inicio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hora_inicio', 'Hora Inicio:') !!}
    {!! Form::text('hora_inicio', null, ['class' => 'form-control']) !!}
</div>

<!-- Hora Fin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hora_fin', 'Hora Fin:') !!}
    {!! Form::text('hora_fin', null, ['class' => 'form-control']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('jornadas.index') !!}" class="btn btn-default">Cancel</a>
</div>
