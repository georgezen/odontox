@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 class="pull-left">Presentaciones</h1>
    <h1 class="pull-right">
      <button type="button" class="btn btn-primary pull-right"  id="modal_ad" data-toggle="modal" data-target="#miModal">Agregar presentación</button>
  </h1>

</section>

@include('presentaciones.modal_create')
@include('presentaciones.modal_edit')


<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body" id="presentacion-table">
            @include('presentaciones.table')
        </div>
    </div>
    <div class="text-center">

    </div>
</div>

@endsection

@section('scripts')
<script>
	jQuery(document).ready(function($) {
		console.log("hola");

		$.ajaxSetup({
    beforeSend: function(xhr, type) {
        if (!type.crossDomain) {
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
        }
    },
});

   


    $('#modal_ad').on('click',function(event) {
      event.preventDefault();
       $('#myModalLabeladd').text('Nueva presentación');      
    });

    $(document).on('click', '.pagination a', function(event) {
         event.preventDefault();
         console.log($(this).attr('href').split('?page=')[1]);
         var page = $(this).attr('href').split('?page=')[1];
         getPagePresentacion(page);
       });

       function getPagePresentacion(page) {
         $.ajax({
           url: '{{ url('/ajax/presentacion?page=') }}'+page,
           type: 'GET'
           
         })
         .done(function(data) {
           console.log(data);
           $('#presentacion-table').html(data);
         });
         
       }




        $('#save_presentacion').on('click', function(e){
            e.preventDefault();
            var descripcion = $('#descripcion').val();
            
            if (descripcion == "") {
                toastr.error("Rellene este campo");
            }else{

                $.ajax({
                    url: '{{ route('add_presentacion') }}',
                   	type: 'POST',
                    dataType: 'json',
                    data: {descripcion:descripcion}
                })
                .done(function(data) {
                   console.log(data);
                   	$('#descripcion').val('');
                   	$("#miModal").modal("hide");
                   	getPagePresentacion(1);
                   toastr.success("Presentacion registrada correctamente");
               });
                
            }
            
        });

    


               $(document).on('click', '.edit', function(event) {
            event.preventDefault();
            var id_presentacion = $(this).data('id');
            $.ajax({
                url: '{{ route('edit_presentacion') }}',
                type: 'GET',
                dataType: 'json',
                data: {id_presentacion: id_presentacion},
            })
            .done(function(data) {
            	console.log(data);
              $('#myModalLabelEdit').text('Editar presentación');      
               $('#id_presentacion_edit').val(data.id_presentacion);
               $('#descripcion_edit1').val(data.data);
               

            });
        });

               $(document).on('click', '#update_presentacion', function(event) {
               	event.preventDefault();
               	var id_presentacion_edit = $('#id_presentacion_edit').val();
               	var edit_presentacion = $('#descripcion_edit1').val();
               	
               	if (edit_presentacion == "") {
               		toastr.error("Rellene este campo");
               	}else{
               		$.ajax({
               		url: '{{ route('update_presentacion') }}',
               		type: 'POST',
               		dataType: 'json',
               		data: {
               			id_presentacion_edit:id_presentacion_edit,
               			edit_presentacion:edit_presentacion,
               			
               		},
               	})
               	.done(function(data) {
               		console.log(data);
               		$("#miModal2").modal("hide");
               		toastr.success("Presentacion actualizada correctamente");
               		$('#presentacion-table').find('.'+id_presentacion_edit).find('#presentacion').html(data.data);
               		
               	});

               	}
               	

               }); 	
       
	});
</script>
@endsection