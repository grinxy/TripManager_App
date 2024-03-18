@extends('layout/template')
@section('title', 'Trip Manager | Viajes')

@section('content')

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <!-- Imagen del viaje -->
                    <img src="{{ $viaje->imagen }}" alt="{{ $viaje->nombre }}" style="width: 100%;">
                </div>
                <div class="col-md-6">
                    <!-- Información del viaje -->
                    <div class="pt-2">
                        <h2 class="pb-3">Viaje {{ $viaje->nombre }}</h2>
                        <p><strong>Salida:</strong> {{ $viaje->fecha_salida }}</p>
                        <p><strong>Regreso:</strong> {{ $viaje->fecha_regreso }}</p>
                        <p><strong>Destino:</strong> {{ $viaje->destino }}</p>
                        <p><strong>Plazas Máximas:</strong> {{ $viaje->num_pax }}</p>
                        <p><strong>Estado:</strong> <span class="badge {{ $viaje->estadoColorClass() }}">{{ $viaje->estado }}</span></p>
                        <p class="price"><sup>€</sup><span class="number">{{ $viaje->precio_persona }}</span><sub>/persona</sub></p>
                        <a href="{{ url('viajes/' . $viaje->id . '/show') }}" class="btn btn-primary px-5 py-2">Crear una reserva</a>

                    </div>
                </div>
            </div>
        </div>
     <div class="container py-4">
            <h2>Reservas</h2>
   {{--
            <a href="{{ url('reservas/create') }}" class="btn btn-primary btn-sm">Nueva Reserva</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Localizador</th>
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
                        <td><span class="badge {{ $reserva->estadoColorClass() }}">{{ $reserva->estado }}</span></td>
                        <td><a href="{{ url('reservas/' . $reserva->id . '/edit') }}" class="btn btn-secondary btn-sm">Editar</a></td>
                        <td>
                            <form action="{{ url('reservas/' . $reserva->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>


                    @endforeach--}}
    </section>
@endsection
