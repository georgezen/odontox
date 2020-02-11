@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<section class="content-header">
     <div class="row">
      <div class="col-sm-3">
        <h1 class="pull-left">Proveedores</h1>
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
      <button type="button" class="btn btn-primary pull-right" id="modal-one1"data-toggle="modal" data-target="#miModal">Añadir proveedor</button>
  </h1>
        
      </div>
    </div>

</section>

@include('proveedores.modal_create')
@include('proveedores.modal_edit')


<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body" id="table-proveedores">
            @include('proveedores.table')
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
      $('#modal-one1').on('click',function(event) {
          event.preventDefault();
          $('#myModalLabeladd').text('Nuevo proveedor');      
      });


      $(document).on('click', '.pagination a', function(event) {
         event.preventDefault();
         console.log($(this).attr('href').split('?page=')[1]);
         var page = $(this).attr('href').split('?page=')[1];
         getPageProveedor(page);
     });

      function getPageProveedor(page) {
         $.ajax({
           url: '{{ url('/ajax/proveedor?page=') }}'+page,
           type: 'GET'

       })
         .done(function(data) {
           console.log(data);
           $('#table-proveedores').html(data);

       });

     }

     $('#form_proveedor').on('submit', function(e){
        e.preventDefault();
        var form = new FormData(this);
        if ($('#nombre').val() == "" || $('#ape_paterno').val() == "" || $('#ape_materno').val() == "" || $('#telefono').val() == "" || $('#calle').val() == "" || $('#colonia').val() == ""  || $('#num_exterior').val() == "" || $('#municipio').val() == "" || $('#estado').val() == "" || $('#pais').val() == "") {
            toastr.error("Rellene todos los campos");
            
        }else{

            $.ajax({
                url: '{{ route('save_proveedor') }}',
                type: 'POST',
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                data: form,

            })
            .done(function(data) {

               console.log(data);

               $("#miModal").modal("hide");
               getPageProveedor(1);                  


               toastr.success("Proveedor registrado correctamente");

           });

        }

    });

     $(document).on('click', '.edit', function(event) {
        event.preventDefault();
        var id_proveedor = $(this).data('id');
        console.log(id_proveedor);
        $.ajax({
            url: '{{ route('edit_proveedor') }}',
            type: 'GET',
            dataType: 'json',
            data: {id_proveedor: id_proveedor},
        })
        .done(function(data) {
            console.log(data);
            $('#myModalLabelEdit').text('Editar proveedor'); 
            $('#id_update_prov').val(data.data.id_proveedor);
            $('#nombre_prov').val(data.data.nombre);
            $('#ape_paterno_prov').val(data.data.ape_paterno);
            $('#ape_materno_prov').val(data.data.ape_materno);
            $('#telefono_prov').val(data.data.telefono);
            $('#calle_prov').val(data.data.calle);
            $('#colonia_prov').val(data.data.colonia);
            $('#num_exterior_prov').val(data.data.num_exterior);
            $('#municipio_prov').val(data.data.municipio);
            $('#estado_prov').val(data.data.estado);
            $('#pais_prov').val(data.data.pais);

        });
    });


     $('#form_edit_proveedor').on('submit', function(e){
        e.preventDefault();
        var form_edit = new FormData(this);
        if ($('#nombre_prov').val() == "" || $('#ape_paterno_prov').val() == "" || $('#ape_materno_prov').val() == "" || $('#telefono_prov').val() == "" || $('#calle_prov').val() == "" || $('#colonia_prov').val() == ""  || $('#num_exterior_prov').val() == "" || $('#municipio_prov').val() == "" || $('#estado_prov').val() == "" || $('#pais_prov').val() == "") {
            toastr.error("Rellene los campos");
        }else{
           

         $.ajax({
          url: '{{ route('update_proveedor') }}',
          type: 'POST',
          dataType: 'json',
          contentType: false,
          cache: false,
          processData:false,
          data:form_edit,
      })
         .done(function(data) {
          console.log(data);
          $("#miModal2").modal("hide");
          toastr.success("Proveedor editado correctamente");
          getPageProveedor(1); 
      });

     }
     
     

 });  


        $(document).on('click', '#delete', function(event) {
            event.preventDefault();
            var id_delete = $(this).data('id');
            var tr ="."+id_delete;
 
            $.ajax({
                url: '{{ route('delete_proveedor') }}',
                type: 'POST',
                dataType: 'JSON',
                data: {id_delete:id_delete},
            })
            .done(function(data) {
                console.log(data);
                if (data.data == 0) {
                    var buton = '<button class="btn btn-success edit"  data-id="'+id_delete+'" data-toggle="modal" data-target="#miModal2"><i class="glyphicon glyphicon-edit"></i></button>'+
                    '<button class="btn btn-danger" id="delete" data-id="'+id_delete+'"><i class="glyphicon glyphicon-ok"></i></button>';
                    $(tr).find('#acciones_prov').html(buton);
                    $(tr).css('background-color', 'red');
                    toastr.success("Proveedor desactivado");
                }else{
                    var buton = '<button class="btn btn-success edit"  data-id="'+id_delete+'" data-toggle="modal" data-target="#miModal2"><i class="glyphicon glyphicon-edit"></i></button>'+
                    '<button class="btn btn-danger" id="delete" data-id="'+id_delete+'"><i class="glyphicon glyphicon-trash"></i></button>';
                    $(tr).find('#acciones_prov').html(buton); 
                    $(tr).css('background-color', 'green');
                    toastr.success("Proveedor activado");
                }
                
            }); 
            
            
            
        });



    $('#search').on('keyup', function(event) {
      var query = $(this).val();
      getFilter(query)
      console.log(query);

    });

    function getFilter(query){
      $.ajax({
       url: '{{ url('/ajax/filtrar_proveedores?query=') }}'+query,
       type: 'GET'
     })
     .done(function(data) {
       $('#table-proveedores').html(data);
      
     });
    }    
 


 });
</script>
@endsection
