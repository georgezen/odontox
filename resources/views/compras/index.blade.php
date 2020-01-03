@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<section class="content-header">
  
  <div class="row">
      <div class="col-sm-3">
        <h1 class="pull-left">Compras</h1>
    </div>
    
      <div class="col-sm-6">
        <div class="form-group">
          <label for="Codigo">Buscar</label>
          <input type="text" class="form-control" id="search" name="search">    
          
      </div>

  </div>

  <div class="col-sm-1">

  </div>

<div class="col-sm-2">
  <a href="{{ route('add_compra') }}" class="btn btn-success">Añadir compra</a>


</div>
</div>

</section>


@include('compras.show_detalles_compra')

<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body" id="table-compras">
            @include('compras.table')
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

 $(document).on('click', '.detalle_compra', function(event) {
      event.preventDefault();
         
       var id_compra = $(this).data('id');
       var total = 0;
       console.log(id_compra);

       $.ajax({
           url: '{{ route('load_id_detalle_compra') }}',
           type: 'GET',
           dataType: 'json',
           data: {id_compra: id_compra},
       })
       .done(function(data) {
        
        console.log(data);
            $.each(data, function(index, val) {
             var fila =   '<tr class="fila_detalle">'+
                                '<td class="cantidad">'+val.cantidad+ '</td>'+
                                '<td>'+val.producto+'</td>'+
                                '<td>$ '+val.precio_compra+'</td>'+
                                '<td>$ '+val.precio_venta+'</td>'+
                                '<td class="subtotal">$ '+(val.cantidad*val.precio_compra)+'</td>'+
                            '</tr>';
             $('#detalle_compr').append(fila);
             total = total + (val.cantidad*val.precio_compra);

           });
            $('#total').html(total);
       });
        $('#myModalLabeladd').text('Detalle de la compra'+" "+id_compra);   

    });  


       $(document).on('click', '.pagination a', function(event) {
         event.preventDefault();
         console.log($(this).attr('href').split('?page=')[1]);
         var page = $(this).attr('href').split('?page=')[1];
         getPageCompra(page);
       });

       function getPageCompra(page) {
         $.ajax({
           url: '{{ url('/ajax/compras?page=') }}'+page,
           type: 'GET'
           
         })
         .done(function(data) {
           console.log(data);
           $('#table-compras').html(data);

         });
         
       }

       //al cerrar la modal de ver detalle de compra, se limpia el tbody para evitar acumulacion de registros
       $("#miModal").on('hidden.bs.modal', function () {
            $('#detalle_compr').html('');
    });

  $('#search').on('keyup', function(event) {
      var query = $(this).val();
      getFilter(query)
      console.log(query);

    });

    function getFilter(query){
      $.ajax({
       url: '{{ url('/ajax/filtrar_compras?query=') }}'+query,
       type: 'GET'
     })
     .done(function(data) {
       $('#table-compras').html(data);
      
     });
    }
     
      
 


 });
</script>
@endsection
