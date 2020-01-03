@section('modal-edit-contenido')
          <form >
          
        

         <input type="hidden" id="id_update" name="id_update" value="">

         <div class="form-group col-sm-6">
          {!! Form::label('nombre', 'Nombre:') !!}
          {!! Form::text('nombre_edit', null, ['class' => 'form-control','id'=>'nombre_edit']) !!}
        </div>

        <!-- Apellido Pat Field -->
        <div class="form-group col-sm-6">
          {!! Form::label('apellido_pat', 'Apellido Pat:') !!}
          {!! Form::text('ape_pat_edit', null, ['class' => 'form-control','id'=>'ape_pat_edit']) !!}
        </div>

        <!-- Apellido Mat Field -->
        <div class="form-group col-sm-6">
          {!! Form::label('apellido_mat', 'Apellido Mat:') !!}
          {!! Form::text('ape_mat_edit', null, ['class' => 'form-control','id'=>'ape_mat_edit']) !!}
        </div>

        <!-- Fecha Nac Field -->
        <div class="form-group col-sm-6">
          {!! Form::label('fecha_nac', 'Fecha Nac:') !!}
          {!! Form::text('fecha_nac_edit', null, ['class' => 'form-control','id'=>'fecha_nac_edit']) !!}
        </div>

        <div class="form-group col-sm-6">
          {!! Form::label('foto', 'Foto:') !!}
          {!! Form::text('foto_edit', null, ['class' => 'form-control','id'=>'foto_edit']) !!}
        </div>

        <div class="form-group col-sm-6">
          {!! Form::label('huella_digital', 'Huella digital:') !!}
          {!! Form::text('huella_edit', null, ['class' => 'form-control','id'=>'huella_edit']) !!}
        </div>

        <!-- Submit Field -->
        <div class="form-group col-sm-5">
          <input  type="button" id="update_trab" class="btn btn-success form-control pull-left" value="Editar">
        </div>

        </form>

@endsection

  






