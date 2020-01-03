@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Trabajadores</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" data-toggle="modal" data-target="#miModal" id="modal-on">Añadir trabajador</a>
        </h1>
    </section>

    @include('trabajadores.edit')
    @include('trabajadores.create')
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body" id="trabajadores-table">
                    @include('trabajadores.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

@section('scripts')
<script>
    jQuery(document).ready(function($) {
        console.log("dsds");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });   

        $('#datetimepicker2').datepicker({
            dateFormat: 'dd-mm-yy'
        });

        $('#modal-on').on('click',function(event) {
      event.preventDefault();
       $('#myModalLabeladd').text('Nuevo trabajador');      
    });


       $(document).on('click', '.pagination a', function(event) {
         event.preventDefault();
         console.log($(this).attr('href').split('?page=')[1]);
         var page = $(this).attr('href').split('?page=')[1];
         getPageTrabajador(page);
       });

       function getPageTrabajador(page) {
         $.ajax({
           url: '{{ url('/ajax/trabajadores?page=') }}'+page,
           type: 'GET'
           
         })
         .done(function(data) {
           console.log(data);
           $('#trabajadores-table').html(data);
         });
         
       }

        

       $('#save_trab').click(function(e) {
            e.preventDefault();
            console.log("dwew");
            let nombre = $('#nombre').val();
            let apellido_pat = $('#apellido_pat').val();
            let apellido_mat = $('#apellido_mat').val();
            let datetimepicker2 = $('#datetimepicker2').val();
            let foto = $('#foto').val();
            let huella_digital = $('#huella_digital').val();

            if (nombre == "" || apellido_pat == "" || apellido_mat == "" || datetimepicker2 == "" || foto == "" || huella_digital == "" ) {
                toastr.error("Rellene los campos");
            }else{

                $.ajax({
                    url: '{{ route('add_trabajador') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        nombre: nombre,
                        apellido_pat: apellido_pat,
                        apellido_mat: apellido_mat,
                        fecha_nac: datetimepicker2,
                        foto: foto,
                        huella_digital: huella_digital
                    },
                })
                .done(function(data) {
                   console.log(data);
                   $('#nombre').val('');
                   $('#apellido_pat').val('');
                   $('#apellido_mat').val('');
                   $('#datetimepicker2').val('');
                   $('#foto').val('');
                   $('#huella_digital').val('');
                   $("#miModal").modal("hide");
                   getPageTrabajador(1);
                   
                   toastr.success("Trabajador creado correctamente");

               });
                
            }
            
        });  

      $('#fecha_nac_edit').datepicker({
            dateFormat: 'dd-mm-yy'
        }); 

      $(document).on('click', '.edit', function(event) {
            event.preventDefault();
            var id_trabajador = $(this).data('id');
            $.ajax({
                url: '{{ route('edit_trabajador') }}',
                type: 'GET',
                dataType: 'json',
                data: {id_trabajador: id_trabajador},
            })
            .done(function(data) {

                console.log(data);
                $('#myModalLabelEdit').text('Editar trabajador');
                $('#id_update').val(data.data.id);
                $('#nombre_edit').val(data.data.nombre);
                $('#ape_pat_edit').val(data.data.apellido_pat);
                $('#ape_mat_edit').val(data.data.apellido_mat);
                $('#fecha_nac_edit').val(data.fecha_edit);
                $('#foto_edit').val(data.data.foto);
                $('#huella_edit').val(data.data.huella_digital);

            });
        });

          $(document).on('click', '#update_trab', function(event) {
           let id_update = $('#id_update').val();
           let nombre_edit = $('#nombre_edit').val();
           let ape_pat_edit = $('#ape_pat_edit').val();
           let ape_mat_edit = $('#ape_mat_edit').val();
           let fecha_nac_edit = $('#fecha_nac_edit').val();
           let foto_edit = $('#foto_edit').val();
           let huella_edit = $('#huella_edit').val();


           if (nombre_edit == "" || ape_pat_edit == "" || ape_mat_edit == "" || fecha_nac_edit == "" || foto_edit == "" || huella_edit == "" ) {
                toastr.error("Rellene los campos");
            }else{

            $.ajax({
               url: '{{ route('update_trabajador') }}',
               type: 'POST',
               dataType: 'json',
               data: {id_update_trab:id_update,
                      nombre_edit:nombre_edit, 
                      ape_pat_edit:ape_pat_edit,
                      ape_mat_edit:ape_mat_edit,
                      fecha_nac_edit:fecha_nac_edit,
                      foto_edit:foto_edit,
                      huella_edit:huella_edit
            },
           })
           .done(function(data) {
                   console.log(data);
                   $('#nombre_edit').val('');
                   $('#ape_pat_edit').val('');
                   $('#ape_mat_edit').val('');
                   $('#fecha_nac_edit').val('');
                   $('#foto_edit').val('');
                   $('#huella_edit').val('');
                     $("#miModal2").modal("hide");
                    $('#info_trab').find('.'+id_update).find('#full_name_trab').html(data.data.nombre+" "+data.data.apellido_pat+" "+data.data.apellido_pat);
                    $('#info_trab').find('.'+id_update).find('#fech_trab').html(data.date);
                    

                    toastr.success("Trabajador editado correctamente");
           });


           }
           
        });


        $(document).on('click', '#delete', function(event) {
            event.preventDefault();
            var id_delete = $(this).data('id');
            var tr ="."+id_delete;
 
            $.ajax({
                url: '{{ route('delete_trabajador') }}',
                type: 'POST',
                dataType: 'JSON',
                data: {id_delete:id_delete},
            })
            .done(function(data) {
                console.log(data);
                if (data.data == 0) {
                    var buton = '<a  class="btn btn-success  edit" data-id="'+id_delete+'" data-toggle="modal" data-target="#miModal2"><i class="glyphicon glyphicon-edit"></i></a>'+
                    '<button class="btn btn-danger" id="delete" data-id="'+id_delete+'"><i class="glyphicon glyphicon-ok"></i></button>';
                    $(tr).find('#acciones_trab').html(buton);
                    $(tr).css('background-color', 'red');
                    toastr.success("Trabajador desactivado");
                }else{
                    var buton = '<a  class="btn btn-success  edit" data-id="'+id_delete+'" data-toggle="modal" data-target="#miModal2"><i class="glyphicon glyphicon-edit"></i></a>'+
                    '<button class="btn btn-danger" id="delete" data-id="'+id_delete+'"><i class="glyphicon glyphicon-trash"></i></button>';
                    $(tr).find('#acciones_trab').html(buton); 
                    $(tr).css('background-color', 'green');
                    toastr.success("Trabajador activado");
                }
                
            }); 
        });     
    });


</script>
@endsection


