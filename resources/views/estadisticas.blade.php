@extends('adminlte::page')

@section('title', 'Estadísticas')

@section('content_header')
    
@stop

@section('content')

<div class="card-body">

<div class="row">
    <div class="col-lg-4 col-8">

        <div class="small-box bg-info">
            <div class="inner">
                    <h3>{{ $data }}</h3>
                <p>Usuarios registrados</p>
                </div>
                <div class="icon">
                <i class="fas fa-user-circle"></i>
                </div>
                <a href="/usuarios" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-8">

        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $data1 }}</h3>
                <p>Proveedores</p>
                </div>
                <div class="icon">
                <i class="fas fa-users"></i>
                </div>
                <a href="/proveedores" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-8">

        <div class="small-box bg-success">
            <div class="inner">
                    <h3>{{ $data2 }}</h3>
                <p>Medicamentos registrados</p>
                </div>
                <div class="icon">
                <i class="fas fa-fw fa-medkit"></i>
                </div>
                <a href="/medicamentos" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

</div>

<div class="row">
<div class="col-xs-12 col-lg-6">
    <div class="card">
                <div class="card-header text-white bg-dark mb-3">{{ __('Listado de medicamentos próximos a vencer') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

        @csrf

        <table class="table table-striped table-hover" id="warning" style='text-align: center; vertical-align: middle;'>
            <thead align="center">
                <tr>
                <th scope="col">Producto</th>
                <th scope="col">Fecha expedición</th>
                <th scope="col">Fecha vencimiento</th>
                <th scope="col">Estado</th>
                </tr>
            </thead>
           
            <tbody>
                @foreach($data4 as $d4)
                    <tr>
                        <td>{{ $d4->med_producto }}</td>
                        <td>{{ $d4->med_fecha_expedicion }}</td>
                        <td>{{ $d4->med_fecha_vencimiento }}</td>
                        <td><span class="badge badge-danger">A vencer</span></td>
                    </tr>
                @endforeach
                <tr><td colspan=4><a href="/medicamentos" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a></td></tr>
            </tbody>
        </table>
                    
                </div>
            </div>
            </div>

    <div class="col-xs-12 col-lg-6">
    <div class="card">
                <div class="card-header text-white bg-dark mb-3">{{ __('Listado de medicamentos pocas cantidades') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

        @csrf

        <table class="table table-striped table-hover" id="warning" style='text-align: center; vertical-align: middle;'>
            <thead align="center">
                <tr>
                <th scope="col">Producto</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Fecha última mod</th>
                </tr>
            </thead>
           
            <tbody>
                @foreach($data3 as $d3)
                    <tr>
                        <td>{{ $d3->med_producto }}</td>
                        <td><span class="badge badge-danger">{{ $d3->med_cantidad }}</span></td>
                        <td>{{ $d3->med_fecha_ult_mod }}</td>
                    </tr>
                @endforeach
                <tr><td colspan=3><a href="/medicamentos" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a></td></tr>
            </tbody>
        </table>
                    
                </div>
            </div>
            </div>

</div>
     
</div>

@stop

@section('js')

    <script>

        $('#warning').DataTable({
            responsive: true,
            autoWidth: false,

        "language": {   
            "lengthMenu": "Mostrar _MENU_ registros de página",
            "zeroRecords": "No se han encontrado registros",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No se han encontrado registros",
            "infoFiltered": "(Filtrando de _MAX_ total de registros)",
            "search": "Busqueda: ",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
        });

    </script>
@endsection