@extends('welcome')

@section('content')
    <section class="content-header">
        <h1>
            Tipo Marcador
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tipoMarcador, ['route' => ['tipoMarcadors.update', $tipoMarcador->id], 'method' => 'patch']) !!}

                        @include('tipo_marcadors.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection