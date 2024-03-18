@extends('layout/template')
@section('title', 'Trip Manager | Reservas')

@section('content')

    <main>
        <div class="container py-4">
            <h2>Reservas</h2>
            <!--busqueda por cliente-->
            <div class="row mt-5">
                <div class="col-md-7">
                    <form id="searchForm" action="{{ route('reservas.index') }}" method="GET">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="nombre_cliente" id="nombre_cliente" class="form-control"
                                style="width: 400px;" placeholder="Buscar por cliente">
                                <button type="submit" id="searchButton" type="button" class="btn btn-primary" data-mdb-ripple-init><i
                                    class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-md-5 text-end">
                    <a href="{{ url('reservas/create') }}" class="btn btn-success mt-1 px-4">Crear Nueva Reserva</a>
                </div>
            </div>
            @if ($reservas->isEmpty())
                <div class="alert alert-info mt-4" role="alert">
                    Cliente no encontrado
                </div>
            @else
                <div class="py-5">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Ref. Reserva</th>
                                <th>Nombre Cliente</th>
                                <th>Viaje</th>
                                <th>Fecha Reserva</th>
                                <th>N Viajeros</th>
                                <th>Precio total</th>
                                <th>Estado</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservas as $reserva)
                                <tr>
                                    <td>{{ $reserva->id }}</td>
                                    <td>{{ $reserva->nombre_cliente }}</td>
                                    <td>{{ $reserva->viaje->nombre }}</td>
                                    <td>{{ $reserva->fecha_reserva }}</td>
                                    <td>{{ $reserva->num_pax }}</td>
                                    <td>{{ $reserva->precio_total }} €</td>
                                    <td><span class="badge {{ $reserva->estadoColorClass() }}">{{ $reserva->estado }}</span>
                                    </td>
                                    <td><a href="{{ url('reservas/' . $reserva->id . '/edit') }}"
                                            class="btn btn-secondary btn-sm">Editar</a></td>
                                    <td>
                                        <form action="{{ url('reservas/' . $reserva->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </main>



@endsection
