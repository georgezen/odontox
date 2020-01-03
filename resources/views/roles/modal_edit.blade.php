@section('modal-edit-contenido')
           <form id="form_edit_rol">
            <input type = "hidden"  id="id_rol_edit" value=""></p>
            <!-- Descripcion Field -->
            <div class="form-group col-sm-6">
              {!! Form::label('descripcion', 'Descripción:') !!}
              {!! Form::text('descripcion', null, ['class' => 'form-control','id' => 'descripcion_edit']) !!}
            </div>

            <!-- Submit Field -->
            <div class="form-group col-sm-12">
              {!! Form::button('Guardar', ['class' => 'btn btn-success','id' => 'update_rol']) !!}

            </div>


          </form>
@endsection
         
