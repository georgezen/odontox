@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Sucursales
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'sucursales.store']) !!}

                        <div class="form-group col-sm-6">
                            {!! Form::label('nombre', 'Nombre:') !!}
                            {!! Form::text('nombre', null, ['class' => 'form-control','id'=>'nombre']) !!}
                        </div>

                        <!-- Submit Field -->
                        <div class="form-group col-sm-12">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary','id'=>'save_sucursal']) !!}
                            <a href="{!! route('sucursales.index') !!}" class="btn btn-danger">Cancelar</a>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

