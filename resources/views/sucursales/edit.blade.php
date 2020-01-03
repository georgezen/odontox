@section('modal-edit-contenido')         
          <form id="suc_update">
                <input type="hidden" name="id_sucursal_update" id="id_sucursal_update">
                
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="edit_sucursal">Sucursal:</label>
                            <input type="text" name="upd_suc" id="upd_suc" value="" class="form-control">
                        </div>
                    </div>
                </div>
                <input type="button" id="update_suc" value="Editar" class="pull-left btn btn-success">
            </form>
@endsection
    



