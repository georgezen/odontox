@extends('home')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Sucursales</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right"  style="margin-top: -10px;margin-bottom: 5px" href="{!! route('sucursales.create') !!}" >Añadir sucursal</a>
        </h1>
    </section>
    @include('sucursales.edit')
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('sucursales.table')
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
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});   

    $('#trabajadores-table').DataTable();

      $(document).on('click', '.edit', function(event) {
            event.preventDefault();
            var id_sucursal = $(this).data('id');
            $.ajax({
                url: '{{ route('edit_sucursal') }}',
                type: 'GET',
                dataType: 'json',
                data: {id_sucursal: id_sucursal},
            })
            .done(function(data) {
                console.log(data);
                $('#myModalLabelEdit').text('Editar sucursal'); 
                $('#id_sucursal_update').val(data.data.id);
                $('#upd_suc').val(data.data.nombre);

            });
        });

              $(document).on('click', '#update_suc', function(event) {
           let upd_suc = $('#upd_suc').val();
           let id_sucursal_update = $('#id_sucursal_update').val();


           if (upd_suc == "") {
               toastr.error("Rellene este campo");
           }else{

            $.ajax({
               url: '{{ route('update_sucursal') }}',
               type: 'POST',
               dataType: 'json',
               data: {id_sucursal_update:id_sucursal_update,
                upd_suc:upd_suc 
            },
           })
           .done(function(data) {
               console.log(data);
                     $("#miModal2").modal("hide");
                    $('#sucursales-table').find('.'+id_sucursal_update).find('#sucursal_nom').html(data.data.nombre);
                    toastr.success("Sucursal editada correctamente");
           });


           }
           
        });


        $(document).on('click', '#delete', function(event) {
            event.preventDefault();
            var id_delete = $(this).data('id');
            var tr ="."+id_delete;
 
            $.ajax({
                url: '{{ route('delete_sucursal') }}',
                type: 'POST',
                dataType: 'JSON',
                data: {id_delete:id_delete},
            })
            .done(function(data) {
                console.log(data);
                if (data.data == 0) {
                    var buton = '<a  class="btn btn-success  edit" data-id="'+id_delete+'" data-toggle="modal" data-target="#miModal2"><i class="glyphicon glyphicon-edit"></i></a>'+
                    '<button class="btn btn-danger" id="delete" data-id="'+id_delete+'"><i class="glyphicon glyphicon-ok"></i></button>';
                    $(tr).find('#suc_acciones').html(buton);
                    $(tr).css('background-color', 'red');
                    toastr.success("Sucursal desactivado");
                }else{
                    var buton = '<a  class="btn btn-success  edit" data-id="'+id_delete+'" data-toggle="modal" data-target="#miModal2"><i class="glyphicon glyphicon-edit"></i></a>'+
                    '<button class="btn btn-danger" id="delete" data-id="'+id_delete+'"><i class="glyphicon glyphicon-trash"></i></button>';
                    $(tr).find('#suc_acciones').html(buton); 
                    $(tr).css('background-color', 'green');
                    toastr.success("Sucursal activada");
                }
                
            }); 
        });     
    });
</script>
@endsection


