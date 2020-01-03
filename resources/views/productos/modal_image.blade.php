<div class="modal fade" id="load_image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close_image" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Cargar imagen</h4>
      </div>
      <div class="modal-body">


        <div class="box-body">
          <div class="row">
            <div id="dropZone">
                {{ Form::open(array('files'=> true, 'enctype'=>'multipart/form-data')) }}
                <input type="hidden" id="id_prod" value="" name="id_product">
                <h1><strong>Cargar imagen</strong></h1>
            <input type="file" id="fileupload" name="imagen" >
            {{ csrf_field() }}
                {{ Form::close() }}
            </div>
            <h1 id="error"></h1>
            <h1 id="progress"></h1>
            

        </div>
      </div>

    </div>
  </div>
</div>
</div>