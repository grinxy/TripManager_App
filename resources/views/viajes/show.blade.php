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
                        <h2 class="pb-2">Viaje {{ $viaje->nombre }}</h2>
                        <p><strong>Salida:</strong> {{ $viaje->fecha_salida }}</p>
                        <p><strong>Regreso:</strong> {{ $viaje->fecha_regreso }}</p>
                        <p><strong>Destino:</strong> {{ $viaje->destino }}</p>
                        <p><strong>Plazas Máximas:</strong> {{ $viaje->num_pax }}</p>
                        <p><strong>Estado:</strong> <span
                                class="badge {{ $viaje->estadoColorClass() }}">{{ $viaje->estado }}</span></p>
                        <p><strong>Viajeros inscritos:</strong> {{ $viajeros }}
                        <p class="price"><sup>€</sup><span
                                class="number">{{ $viaje->precio_persona }}</span><sub>/persona</sub></p>

                    </div>
                </div>
            </div>
        </div>


        <div class="container py-4">
            <form id="reservaDesdeViaje" action="{{ route('reservas.create') }}" method="GET" class="d-inline">
                @csrf
                <input type="hidden" name="id_viaje" value="{{ $viaje->id }}"> <!--pasar en oculto la id del viaje-->
                @if ($viaje->estado === 'completo')
                    <button type="button" class="btn btn-secondary px-4 mx-2 py-2 mb-5" disabled>Viaje completo</button>
                @else
                    <button type="submit" class="btn btn-primary px-4 mx-2 py-2 mb-5">Crear una reserva</button>
                @endif
            </form>
            <a href="{{ url('viajes/' . $viaje->id . '/edit') }}" class="btn btn-warning px-4 mx-2 py-2 mb-5">Editar</a>

            <form id="deleteForm_{{ $viaje->id }}" action="{{ url('viajes/' . $viaje->id) }}" method="post"
                class="d-inline">
                @method('DELETE')
                @csrf
                <button type="button" onclick="confirmDelete({{ $viaje->id }})"
                    class="btn btn-danger px-4 mx-2 py-2 mb-5">Eliminar</button>
            </form>
            <a href="{{ url('viajes') }}" class="btn btn-secondary px-3 mx-2 py-2 mb-5">Volver</a>

        </div>

        <div class="container py-4">



            <h2>Reservas</h2>
            @if ($reservas->isEmpty())
                <div class="alert alert-info" role="alert">
                    No hay reservas para mostrar
                </div>
            @else
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
                                <td><span class="badge {{ $reserva->estadoColorClass() }}">{{ $reserva->estado }}</span>
                                </td>
                                <td><a href="{{ url('reservas/' . $reserva->id . '/edit') }}"
                                        class="btn btn-secondary btn-sm">Editar</a></td>
                                <td>
                                    <form id="deleteForm_{{ $reserva->id }}"
                                            action="{{ url('reservas/' . $reserva->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button" onclick="confirmDelete({{ $reserva->id }})"
                                                class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            @endif
        </div>

    </section>
    <script>
        function confirmDelete(id) {
            // Mostrar una alerta personalizada de SweetAlert2
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede revertir y afectará a todas las reservas asociadas',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0000ff',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                // Si el usuario confirma, enviar el formulario de eliminación
                if (result.isConfirmed) {
                    var form = document.getElementById('deleteForm_' + id);
                    form.submit();
                    // Mostrar una alerta con SweetAlert2 después de enviar el formulario
                    setTimeout(function() {
                        Swal.fire(
                            'Eliminado!',
                            'El viaje ha sido eliminado.',
                            'success'
                        );
                    }, 500);
                }
            });
        }
        function confirmDeleteReserva(id) {
            // Mostrar una alerta personalizada de SweetAlert2
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede revertir',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0000ff',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                // Si el usuario confirma, enviar el formulario de eliminación
                if (result.isConfirmed) {
                    var form = document.getElementById('deleteForm_' + id);
                    form.submit();
                    // Mostrar una alerta con SweetAlert2 después de enviar el formulario
                    setTimeout(function() {
                        Swal.fire(
                            'Eliminado!',
                            'La reserva ha sido eliminada.',
                            'success'
                        );
                    }, 500);
                }
            });
        }
    </script>

@endsection
