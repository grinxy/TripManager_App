@extends('layout/template')
@section('title', 'Nueva Reserva')

@section('content')
    <main>
        <div class="container py-4">
            <h2 class="py-4">Crear nueva Reserva</h2>

            @if ($errors->any())
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Error en los datos introducidos</strong> Por favor revísalos y vuelve a enviar el formulario

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form action="{{ url('reservas') }}" method="post">
                @csrf
                <div class="mb-3 row">
                    <label for="id_viaje" class="col-sm-2 col-form-label">Viaje</label>
                    <div class="col-sm-5">
                        <select name="id_viaje" id="id_viaje" class="form-select" required>
                            <option value=""> Seleccionar Viaje</option>
                            @foreach ($viajes as $viaje)
                                <option value="{{ $viaje->id }}" precio_persona="{{ $viaje->precio_persona }}">
                                    {{ $viaje->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nombre_cliente" class="col-sm-2 col-form-label">Nombre Cliente</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="nombre_cliente" id="nombre_cliente"
                            value="{{ old('nombre_cliente') }}" required>

                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="num_pax" class="col-sm-2 col-form-label">Número viajeros</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="num_pax" id="num_pax"
                            value="{{ old('num_pax') }}" required>

                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="estado" class="col-sm-2 col-form-label">Estado reserva</label>
                    <div class="col-sm-5">
                        <select name="estado" id="estado" class="form-select" required>
                            <option value="">Seleccionar estado</option>
                            <option value="reservada">Reserva hecha</option>
                            <option value="pagada">Pago confirmado</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="precio_total" class="col-sm-2 col-form-label">Precio total reserva</label>
                    <div class="col-sm-5">
                        <p class="py-2" id="precio_total"></p> <!-- Aquí se mostrará el resultado del cálculo -->
                    </div>
                </div>
                <a href="{{ url('reservas') }}" class="my-4 btn btn-secondary"> Volver</a>
                <button type="submit" class="my-4 btn btn-success"> Guardar</button>
            </form>
        </div>
    </main>


    <script>
        //calcular precio total reserva: num personas * precio viaje seleccionado
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener elementos del DOM
            var numPaxInput = document.getElementById('num_pax');
            var viajeSelect = document.getElementById('id_viaje');
            var precioTotalInput = document.getElementById('precio_total');

            // Evento para detectar cambios en el número de viajeros y el viaje seleccionado
            numPaxInput.addEventListener('change', calcularPrecioTotal);
            viajeSelect.addEventListener('change', calcularPrecioTotal);

            function calcularPrecioTotal() {
                var numPax = isNaN(parseInt(numPaxInput.value)) ? 0 : parseInt(numPaxInput
                .value); //0 inicial antes de que calcule
                var precioPersona = parseFloat(viajeSelect.options[viajeSelect.selectedIndex].getAttribute(
                    'precio_persona'));

                var precioTotal = numPax * precioPersona;

                precioTotalInput.textContent = precioTotal.toFixed(
                    2) + '€';

            }
        });
    </script>
@endsection
