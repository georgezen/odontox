@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<section class="content-header">
    <h1 class="pull-left">Roles</h1>
    <h1 class="pull-right">
      <button type="button" class="btn btn-primary pull-right" id="modal-one1"data-toggle="modal" data-target="#miModal">Agregar rol</button>
      
  </h1>

</section>

@include('roles.modal_create')
@include('roles.modal_edit')


<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">
            @include('roles.table')
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


    $('#modal-one1').on('click',function(event) {
      event.preventDefault();
       $('#myModalLabeladd').text('Nuevo rol');      
    });
       

        function loading(argument) {
            // body...
            var info = "";
            $.get('{{ route('read_roles') }}', function(data) {
                $.each(data, function(index, val) {
                  console.log(val);
                  if (val.activo == 1) {
                       info = "<tr class='"+val.id+"' style='background-color:green;'>"+
                    "<td id='id_rol'>"+val.id+"</td>"+
                    "<td id='descripcion_rol'>"+val.descripcion+"</td>"+
                    "<td id='acciones_rol'>"+
                    "<button class='btn btn-success' id='edit' data-id='"+val.id+"' data-toggle='modal' data-target='#miModal2'><i class='glyphicon glyphicon-edit'></i></button>"+
                    "<button class='btn btn-danger' id='delete' data-id="+val.id+"><i class='glyphicon glyphicon-trash'></i></button>"+
                    "</td>"+
                    "</tr>";

                  }else{
                     info = "<tr class='"+val.id+"' style='background-color:red;'>"+
                    "<td id='id_rol'>"+val.id+"</td>"+
                    "<td id='descripcion_rol'>"+val.descripcion+"</td>"+
                    "<td id='acciones_rol'>"+
                    "<button class='btn btn-success' id='edit' data-id='"+val.id+"' data-toggle='modal' data-target='#miModal2'><i class='glyphicon glyphicon-edit'></i></button>"+
                    "<button class='btn btn-danger' id='delete' data-id="+val.id+"><i class='glyphicon glyphicon-ok'></i></button>"+
                    "</td>"+
                    "</tr>";
                  }

                  
                   $('#info_roles').append(info);
               });
            });
        }

        loading();

        $('#save_rol').click(function(e) {
            e.preventDefault();
            let data = $('#descripcion').val();
            if (data == "") {
                toastr.error("Rellene este campo");
            }else{

                $.ajax({
                    url: '{{ route('save_roles') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {descripcion: data},
                })
                .done(function(data) {
                   console.log("dsd");
                   $('#descripcion').val('');
                   $("#miModal").modal("hide");
                   let fila = "<tr class='"+data.id+"' style='background-color:green;'>"+
                   "<td id='id_rol'>"+data.id+"</td>"+
                   "<td id='descripcion_rol'>"+data.data.descripcion+"</td>"+
                   "<td id='acciones_rol'>"+
                   "<button class='btn btn-success' id='edit' data-id='"+data.id+"' data-toggle='modal' data-target='#miModal2'><i class='glyphicon glyphicon-edit'></i></button>"+
                   "<button class='btn btn-danger' id='delete' data-id="+data.id+"><i class='glyphicon glyphicon-trash'></i></button>"+
                   "</td>"+
                   "</tr>";
                   $('#info_roles').append(fila);
                   toastr.success("Rol creado correctamente");

               });
                
            }
            
        });

        $(document).on('click', '#edit', function(event) {
            event.preventDefault();
            var id_rol = $(this).data('id');
            $.ajax({
                url: '{{ route('edit_rol') }}',
                type: 'GET',
                dataType: 'json',
                data: {id_rol: id_rol},
            })
            .done(function(data) {
              $('#myModalLabelEdit').text('Editar rol'); 
               $('#descripcion_edit').val(data.data.descripcion);
               $('#id_rol_edit').val(data.id);

            });
        });

        $(document).on('click', '#update_rol', function(event) {
           let descripcion_edit = $('#descripcion_edit').val();
           let id_rol_edit = $('#id_rol_edit').val();


           if (descripcion_edit == "") {
               toastr.error("Rellene este campo");
           }else{

            $.ajax({
               url: '{{ route('update_role') }}',
               type: 'POST',
               dataType: 'json',
               data: {id_rol_edit:id_rol_edit,descripcion_edit:descripcion_edit },
           })
           .done(function(data) {
               console.log(data);
                     $("#miModal2").modal("hide");
                    $('#roles-table').find('.'+id_rol_edit).find('#descripcion_rol').html(data.data.descripcion);
                    toastr.success("Rol editado correctamente");
           });


           }
           
        });

        $(document).on('click', '#delete', function(event) {
            event.preventDefault();
            var id_rol = $(this).data('id');
            var tr ="."+id_rol;
 
            $.ajax({
                url: '{{ route('delete_role') }}',
                type: 'POST',
                dataType: 'JSON',
                data: {id_rol:id_rol},
            })
            .done(function(data) {
                console.log(data);
                if (data.data == 0) {
                  var buton = '<button class="btn btn-success edit"  data-id="'+id_rol+'" data-toggle="modal" data-target="#miModal2"><i class="glyphicon glyphicon-edit"></i></button>'+
                  '<button class="btn btn-danger" id="delete" data-id="'+id_rol+'"><i class="glyphicon glyphicon-ok"></i></button>';
                  $(tr).find('#acciones_rol').html(buton);
                  $(tr).css('background-color', 'red');
                  toastr.success("Rol desactivado");
                }else{
                  var buton = '<button class="btn btn-success edit"  data-id="'+id_rol+'" data-toggle="modal" data-target="#miModal2"><i class="glyphicon glyphicon-edit"></i></button>'+
                  '<button class="btn btn-danger" id="delete" data-id="'+id_rol+'"><i class="glyphicon glyphicon-trash"></i></button>';
                  $(tr).find('#acciones_rol').html(buton); 
                  $(tr).css('background-color', 'green');
                    toastr.success("Rol activado");
                }
            });
            
            
            
        });
        

    });
</script>
@endsection
