@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<section class="content-header">
    
    <div class="row">
      <div class="col-sm-3">
        <h1 class="pull-left">Productos</h1>
      </div>
     <form >
      <div class="col-sm-6">
        <div class="form-group">
          <label for="Codigo">Buscar</label>
        <input type="text" class="form-control" id="search" name="search">    
          
        </div>
        
      </div>
      
      <div class="col-sm-1">
       
      </div>
      </form>
      <div class="col-sm-2">
        <h1 class="pull-right">
      <button type="button" class="btn btn-primary pull-right" id="modal-one" data-toggle="modal" data-target="#miModal">Agregar producto</button>
  </h1>
        
      </div>
    </div>
    
    

</section>

@include('productos.modal_create')
@include('productos.modal_image')
@include('productos.modal_edit')


<div class="content">
    

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body" id="productos-table">
            @include('productos.table')
        </div>
    </div>
    <div class="text-center">

    </div>
</div>

@endsection

@section('scripts')
<script>
	jQuery(document).ready(function($) {
		

		$.ajaxSetup({
    beforeSend: function(xhr, type) {
        if (!type.crossDomain) {
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
        }
    },
});

    $('#search').on('keyup', function(event) {
      var query = $(this).val();
      getFilter(query)
      console.log(query);

    });

    function getFilter(query){
      $.ajax({
       url: '{{ url('/ajax/filtrar_productos?query=') }}'+query,
       type: 'GET'
     })
     .done(function(data) {
       $('#productos-table').html(data);
      
     });
    }


    $('#modal-one').on('click',function(event) {
      event.preventDefault();
       $('#myModalLabeladd').text('Nuevo producto');      
    });

       $(document).on('click', '.pagination a', function(event) {
         event.preventDefault();
         console.log($(this).attr('href').split('?page=')[1]);
         var page = $(this).attr('href').split('?page=')[1];
         getPageProduct(page);
       });

       function getPageProduct(page) {
         $.ajax({
           url: '{{ url('/ajax/producto?page=') }}'+page,
           type: 'GET'
           
         })
         .done(function(data) {
           console.log(data);
           $('#productos-table').html(data);

         });
         
       }


        $('#form_producto').on('submit', function(e){
            e.preventDefault();
            let img = "";
            if ($('#codigo').val() == "" || $('#nombre').val() == "" || $('#descripcion').val() == "") {
                toastr.error("Rellene todos los campos");
            }else{

                $.ajax({
                    url: '{{ route('save_producto') }}',
                   	type: 'POST',
                    dataType: 'json',
                    contentType: false,
            		cache: false,
            		processData:false,
                    data: new FormData(this),
                    
                })
                .done(function(data) {
                  $('#error_add_producto').html('');
                   console.log(data.data.imagen);
                   $('#codigo').val('');
                   $('#nombre').val('');
                   $('#descripcion').val('');
                   
                   $('#imagen').val('');
                   $("#miModal").modal("hide");
                  getPageProduct(1);                  

                  
                   toastr.success("Producto registrado correctamente");

               });
                
            }
            
        });

        $(document).on('click', '#cargar_id', function(event) {
        	event.preventDefault();
        	let id_producto = $(this).data('id');
        	$.ajax({
        		url: '{{ route('load_id') }}',
        		type: 'get',
        		dataType: 'json',
        		data: {id_producto: id_producto},
        	})
        	.done(function(data) {
        		
        		$('#id_prod').val(data.id_producto);
        	});
        	
        });
        
        	$('#fileupload').fileupload({
        		
        		url:'{{ route('upload_image') }}',
        		dropZone:"#dropZone",
        		dataType: "json",
        		autoUpload: false,

        	}).on('fileuploadadd', function(e,data) {
        		var fileTypeAllowed = /.\.(jpg|png|jpeg)$/i;
        		var nombre = data.originalFiles[0]['name'];
        		var tamanio = data.originalFiles[0]['size'];
        		var id_producto = $('#id_prod').val();
        		console.log(id_producto);

        		if (!fileTypeAllowed.test(nombre)) {
        			$('#error').html("Carga una imagen").css('color', 'red');
        		}else if (tamanio > 2000000) {
        			$('#error').html("Supera el tamaño permitido").css('color', 'red');
        		}else{
        			$('#error').html("");
        			data.submit();
        			
        		}
        		
        	}).on('fileuploaddone', function(e,data) {
        		
        		console.log(data.result);
        		
        		$('#productos-table').find('.'+data.result.id_producto).find('#imagen_pro').html('<img style="width:100px; heigth:100px;" class="pull-left" src="imagenes/'+data.result.data+'">');
        		toastr.success("Imagen cargada");	
        		$("#load_image").modal("hide");
        		$('#progress').html('');
        		$('#error').html("");

        	}).on('fileuploadprogressall', function(e,data) {
        		var progress = parseInt(data.loaded / data.total * 100,10);
        		$('#progress').html('Completado' + progress + "%");
        	});

        	$(document).on('click', '.close_image', function(event) {
        		$('#progress').html('');
        		$('#error').html("");
        		
        	});


               $(document).on('click', '.edit', function(event) {
            event.preventDefault();
            var id_producto = $(this).data('id');
            $.ajax({
                url: '{{ route('edit_producto') }}',
                type: 'GET',
                dataType: 'json',
                data: {id_producto: id_producto},
            })
            .done(function(data) {
            	console.log(data);
              $('#myModalLabelEdit').text('Editar producto'); 
               $('#id_pro_update').val(data.id_producto);
               $('#edit_codigo').val(data.data.codigo);
               $('#edit_nombre').val(data.data.nombre);
               $('#edit_descripcion').val(data.data.descripcion);
               

            });
        });

               $(document).on('click', '#update_producto', function(event) {
               	event.preventDefault();
               	var id_pro_edit = $('#id_pro_update').val();
               	var edit_codigo = $('#edit_codigo').val();
               	var edit_nombre = $('#edit_nombre').val();
               	var edit_descripcion = $('#edit_descripcion').val();
               	var edit_stock = $('#edit_stock').val();
                if ($('#edit_codigo').val() == "" || $('#edit_nombre').val() == "" || $('#edit_descripcion').val() == "") {
                    toastr.error("Rellene los campos");
                }else{
                   $('#error_upt').html("");
                   $.ajax({
                      url: '{{ route('update_producto') }}',
                      type: 'POST',
                      dataType: 'json',
                      data: {
                        id_pro_edit:id_pro_edit,
                        edit_codigo:edit_codigo,
                        edit_nombre:edit_nombre,
                        edit_descripcion:edit_descripcion,
                        edit_stock:edit_stock
                    },
                })
                   .done(function(data) {
                      console.log(data);
                      $("#miModal2").modal("hide");
                      toastr.success("Producto editado correctamente");
                      getPageProduct(1); 
                });

            }
               	
              

               }); 	


        $(document).on('click', '#delete', function(event) {
            event.preventDefault();
            var id_delete = $(this).data('id');
            var tr ="."+id_delete;
 
            $.ajax({
                url: '{{ route('off_producto') }}',
                type: 'POST',
                dataType: 'JSON',
                data: {id_delete:id_delete},
            })
            .done(function(data) {
                console.log(data);
                if (data.data == 0) {
                	var buton = '<button class="btn btn-success edit"  data-id="'+id_delete+'" data-toggle="modal" data-target="#miModal2"><i class="glyphicon glyphicon-edit"></i></button>'+
                	'<button class="btn btn-danger" id="delete" data-id="'+id_delete+'"><i class="glyphicon glyphicon-ok"></i></button>';
                	$(tr).find('#acciones_pro').html(buton);
                	$(tr).css('background-color', 'red');
                	toastr.success("Producto desactivado");
                }else{
                	var buton = '<button class="btn btn-success edit"  data-id="'+id_delete+'" data-toggle="modal" data-target="#miModal2"><i class="glyphicon glyphicon-edit"></i></button>'+
                	'<button class="btn btn-danger" id="delete" data-id="'+id_delete+'"><i class="glyphicon glyphicon-trash"></i></button>';
                	$(tr).find('#acciones_pro').html(buton); 
                	$(tr).css('background-color', 'green');
                    toastr.success("Producto activado");
                }
                
            });	
            
            
            
        });



        
	});
</script>
@endsection