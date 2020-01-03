@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<section class="content-header">

    <div class="row">
      <div class="col-sm-3">
        <h1 class="pull-left">Stock de los productos</h1>
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
  <a href="" class="btn btn-primary" id="reporte_alm">Generar PDF</a>  


</div>
</div>



</section>




<div class="content">


    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body" id="almacen-table">
           
           @include('almacen.table')
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


        $('#search').on('keyup', function(event) {
      var query = $(this).val();
      getFilter(query)
      console.log(query);

    });

    function getFilter(query){
      $.ajax({
       url: '{{ url('/ajax/filtrar_productos2?query=') }}'+query,
       type: 'GET'
     })
     .done(function(data) {
       $('#almacen-table').html(data);
      
     });
    }


    $(document).on('click', '.pagination a', function(event) {
         event.preventDefault();
         console.log($(this).attr('href').split('?page=')[1]);
         var page = $(this).attr('href').split('?page=')[1];
         getPageProduct(page);
       });

       function getPageProduct(page) {
         $.ajax({
           url: '{{ url('/ajax/producto2?page=') }}'+page,
           type: 'GET'
           
         })
         .done(function(data) {
           console.log(data);
           $('#almacen-table').html(data);

         });
         
       }

       //evento de click para sacar el reporte
       $(document).on('click', '#reporte_alm', function(event) {
         event.preventDefault();

         var ruta = "{{ route('reportes')}}";
          
          window.open(ruta, 'Reporte');
          
          return false;

         });
       

});

   
</script>
@endsection