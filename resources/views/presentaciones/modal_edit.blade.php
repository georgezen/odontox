
@section('modal-edit-contenido')

<form id="form_presentacion">
  <input type="hidden" name="id_presentacion_edit" id="id_presentacion_edit">
  <div class="row">
    <div class="col-sm-12">
      <div class="form-group">
        <label for="">Descripción</label>
        <input type="text" class="form-control" name="descripcion_edit" id="descripcion_edit1" value="">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-2 pull-left">
      <input type="button" class="form-control btn btn-success" value="Editar" id="update_presentacion">   
    </div>
  </div>



</form>
@endsection
