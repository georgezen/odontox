@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<section class="content-header">

    <div class="row">
      <div class="col-sm-3">
        <h1 class="pull-left">Clientes</h1>
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
      <button type="button" class="btn btn-primary pull-right" id="modal-one" data-toggle="modal" data-target="#miModal">Agregar cliente</button>
  </h1>

</div>
</div>



</section>

@include('clientes.modal_create')

@include('clientes.modal_edit')


<div class="content">


    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body" id="clientes-table">
            @include('clientes.table')
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

        $('#modal-one').on('click',function(event) {
          event.preventDefault();
          $('#myModalLabeladd').text('Nuevo cliente');      
      });

        $(document).on('click', '.pagination a', function(event) {
           event.preventDefault();
           console.log($(this).attr('href').split('?page=')[1]);
           var page = $(this).attr('href').split('?page=')[1];
           getPageCliente(page);
       });

        function getPageCliente(page) {
           $.ajax({
             url: '{{ url('/ajax/cliente?page=') }}'+page,
             type: 'GET'

         })
           .done(function(data) {
             console.log(data);
             $('#clientes-table').html(data);

         });

       }

       //funcion para registro de clientes
       $('#form_cliente').on('submit', function(e){
        e.preventDefault();

        if ($('#nombre').val() == "" || $('#ape_paterno').val() == "" || $('#ape_materno').val() == "" || $('#edad').val() == "" || $('#telefono').val() == "" || $('#calle').val() == "" || $('#num_exterior').val() == "" || $('#colonia').val() == "") {
            toastr.error("Rellene todos los campos");
        }else{

            $.ajax({
                url: '{{ route('save_cliente') }}',
                type: 'POST',
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                data: new FormData(this),

            })
            .done(function(data) {

             console.log(data);

             $("#miModal").modal("hide");
             getPageCliente(1);                  


             toastr.success("Cliente registrado correctamente");

         });

        }

    });

       $(document).on('click', '.edit', function(event) {
        event.preventDefault();
        var id_cliente = $(this).data('id');
        console.log(id_cliente);
        $.ajax({
            url: '{{ route('edit_cliente') }}',
            type: 'GET',
            dataType: 'json',
            data: {id_cliente: id_cliente},
        })
        .done(function(data) {
            console.log(data);

            $('#myModalLabelEdit').text('Editar cliente'); 
            $('#id_cli_u').val(data.data.id_cliente);
            $('#nombre_edit').val(data.data.nombre);
            $('#ape_paterno_edit').val(data.data.ape_paterno);
            $('#ape_materno_edit').val(data.data.ape_materno);
            $('#edad_edit').val(data.data.edad);
            $('#telefono_edit').val(data.data.telefono);
            $('#calle_edit').val(data.data.calle);
            $('#num_exterior_edit').val(data.data.num_exterior);
            $('#colonia_edit').val(data.data.colonia);
            $('#ciudad_edit').val(data.data.ciudad);
            $('#estado_edit').val(data.data.estado);
            $('#pais_edit').val(data.data.pais);

        });
    });


           $('#form_cliente_edit').on('submit', function(e){
            event.preventDefault();
            var form_cliente_ed = new FormData(this);

            if ($('#nombre_edit').val() == "" || $('#ape_paterno_edit').val() == "" || $('#ape_materno_edit').val() == "" || $('#edad_edit').val() == "" || $('#telefono_edit').val() == "" || $('#calle_edit').val() == "" || $('#num_exterior_edit').val() == "" || $('#colonia_edit').val() == "") {
                toastr.error("Rellene todos los campos");
            }else{
             $('#error_upt').html("");
             $.ajax({
              url: '{{ route('update_cliente') }}',
              type: 'POST',
              dataType: 'json',
              contentType: false,
              cache: false,
              processData:false,
              data: form_cliente_ed,
          })
             .done(function(data) {
              console.log(data);
              $("#miModal2").modal("hide");
              toastr.success("Cliente editado correctamente");
              getPageCliente(1);                  
          });

         }



     });  

      $(document).on('click', '#delete', function(event) {
            event.preventDefault();
            var id_delete = $(this).data('id');
            var tr ="."+id_delete;
 
            $.ajax({
                url: '{{ route('delete_cliente') }}',
                type: 'POST',
                dataType: 'JSON',
                data: {id_delete:id_delete},
            })
            .done(function(data) {
                console.log(data);
                if (data.data == 0) {
                    var buton = '<button class="btn btn-danger" id="delete" data-id="'+id_delete+'"><i class="glyphicon glyphicon-ok"></i></button>';
                    $(tr).find('.accio_cli').html(buton);
                    $(tr).css('background-color', 'red');
                    toastr.success("Cliente desactivado");
                }else{
                    var buton = '<button class="btn btn-success edit"  data-id="'+id_delete+'" data-toggle="modal" data-target="#miModal2"><i class="glyphicon glyphicon-edit"></i></button>'+
                    '<button class="btn btn-danger" id="delete" data-id="'+id_delete+'"><i class="glyphicon glyphicon-trash"></i></button>';
                    $(tr).find('.accio_cli').html(buton); 
                    $(tr).css('background-color', 'green');
                    toastr.success("Cliente activado");
                }
                
            }); 
            
            
            
        });       




   });
</script>
@endsection