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
                                        <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar esta reserva?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Eliminar</button>
            </div>
        </div>
    </div>
</div>
                                        <form id="deleteForm_{{ $reserva->id }}" action="{{ url('reservas/' . $reserva->id) }}"
                                            method="post">
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
                </div>
            @endif
        </div>
    </main>


    <script>
        function confirmDelete(id) {
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
