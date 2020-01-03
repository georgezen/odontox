@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<section class="content-header">
    

    <div class="row">
      <div class="col-sm-3">
        <h1 >Ventas</h1>
        
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="Codigo">Buscar</label>
          <input type="text" class="form-control" id="search" name="search">    
          
      </div>
      </div>
      <div class="col-sm-3">
        <h1 class="pull-right">
       <a href="{{ route('add_venta') }}" class="btn btn-success">Añadir venta</a>
      
       </h1>
        
      </div>
    </div>
    

</section>

@include('ventas.show_detalle_venta')


<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body" id="table-ventas">
            @include('ventas.table')
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


     $(document).on('click', '.detalle_venta', function(event) {
      event.preventDefault();
         
       var id_venta = $(this).data('id');
       var total = 0;
       console.log(id_venta);

       $.ajax({
           url: '{{ route('load_id_detalle_venta') }}',
           type: 'GET',
           dataType: 'json',
           data: {id_venta: id_venta},
       })
       .done(function(data) {
        
        console.log(data);
            $.each(data, function(index, val) {
             var fila =   '<tr class="fila_detalle">'+
                                '<td class="cantidad">'+val.cantidad+ '</td>'+
                                '<td>'+val.producto+'</td>'+
                                '<td>$ '+val.precio_venta+'</td>'+
                                '<td>'+val.descuento+' %</td>'+
                                '<td class="subtotal">$ '+(val.cantidad*val.precio_venta)+'</td>'+
                            '</tr>';
             $('#detalle_vent').append(fila);
             total = total + (val.cantidad*val.precio_venta);

             

           });
            $('#total').html(data[0].total);
       });
        $('#myModalLabeladd').text('Detalle de la venta'+" "+id_venta);   

    });  


      //Funciones para la paginacion de la info
       $(document).on('click', '.pagination a', function(event) {
         event.preventDefault();
         console.log($(this).attr('href').split('?page=')[1]);
         var page = $(this).attr('href').split('?page=')[1];
         getPageVenta(page);
       });

       function getPageVenta(page) {
         $.ajax({
           url: '{{ url('/ajax/ventas?page=') }}'+page,
           type: 'GET'
           
         })
         .done(function(data) {
           console.log(data);
           $('#table-ventas').html(data);

         });
         
       }

       //al cerrar la modal de ver detalle de compra, se limpia el tbody para evitar acumulacion de registros
       $("#miModal").on('hidden.bs.modal', function () {
            $('#detalle_vent').html('');
    });


        $('#search').on('keyup', function(event) {
      var query = $(this).val();
      getFilter(query)
      console.log(query);

    });

    function getFilter(query){
      $.ajax({
       url: '{{ url('/ajax/filtrar_ventas?query=') }}'+query,
       type: 'GET'
     })
     .done(function(data) {
       $('#table-ventas').html(data);
      
     });
    }
      
 
    


    
    });
</script>
@endsection
