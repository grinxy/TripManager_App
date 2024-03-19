<div class="container py-4">
    @if ($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Error en los datos introducidos</strong> Por favor revísalos y vuelve a enviar el formulario

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <form action="{{ isset($reserva) ? url('reservas/' . $reserva->id) : url('reservas') }}" method="post">
        @csrf
        <!--si $reserva está definida->modo edicion -->
        @isset($reserva)
            @method('PUT')
        @endisset

        <div class="row mb-3 ">
            <label for="id_viaje" class="col-sm-2 col-form-label">Viaje</label>
            <div class="col-sm-5">
                <select name="id_viaje" id="id_viaje" class="form-select" required>

                    <!-- Si el usuario viene desde pagina viaje concreto o edita una reserva existente-->
                    @isset($viaje)
                        <option value="{{ $viaje->id }}"
                            precio_persona="{{ $viaje->precio_persona }}"data-plazas-disponibles="{{ $viaje->plazas_disponibles }}"
                            selected>
                            {{ $viaje->nombre }}
                        </option>
                    @else
                        <option value="" disabled selected>Seleccionar Viaje</option>
                        <!-- Mostrar todos los viajes disponibles -->
                        @foreach ($viajes as $viajeOption)
                            <option value="{{ $viajeOption->id }}" precio_persona="{{ $viajeOption->precio_persona }}"
                                data-plazas-disponibles="{{ $viajeOption->plazas_disponibles }}">
                                {{ $viajeOption->nombre }}
                            </option>
                        @endforeach


                    @endisset
                </select>
            </div>


        </div>

        <!-- calcular plazas disponibles segun desde donde accede el usuario-->
        <div class="mb-3 row">
            <label for="num_pax" class="col-sm-2 col-form-label">Número viajeros</label>
            <div class="col-sm-5">

                @isset($viaje)
                    <input type="number" class="form-control" name="num_pax" id="num_pax"
                        value="{{ isset($reserva) ? $reserva->num_pax : old('num_pax') }}" required min="1"
                        max="{{ $plazasMaximas }}">
                    <p class="text-muted small"> Plazas disponibles: {{ $viaje->plazas_disponibles }}</p>
                @else
                    <input type="number" class="form-control" name="num_pax" id="num_pax"
                        value="{{ isset($reserva) ? $reserva->num_pax : old('num_pax') }}" required min= "1"
                        max='12'>
                    <p class="text-muted small" id="plazas_disponibles">Plazas disponibles: </p>
                @endisset

            </div>
        </div>
        <div class="mb-3 row">
            <label for="nombre_cliente" class="col-sm-2 col-form-label">Nombre Cliente</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="nombre_cliente" id="nombre_cliente"
                    value="{{ isset($reserva) ? $reserva->nombre_cliente : old('nombre_cliente') }}" required>

            </div>
        </div>

        <div class="mb-3 row">
            <label for="estado" class="col-sm-2 col-form-label">Estado reserva</label>
            <div class="col-sm-5">
                <select name="estado" id="estado" class="form-select" required>
                    <option value="">Seleccionar estado</option>
                    <option value="reservada"
                        {{ isset($reserva) && $reserva->estado == 'Reserva hecha' ? 'selected' : '' }}>
                        Reserva hecha
                    </option>
                    <option value="pagada" {{ isset($reserva) && $reserva->estado == 'Pagada' ? 'selected' : '' }}>Pago
                        confirmado</option>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="precio_total" class="col-sm-2 col-form-label">Precio total reserva</label>
            <div class="col-sm-5">
                <p class="py-2" id="precio_total"></p> <!-- Resultado del cálculo  JS -->
            </div>
        </div>
        <a href={{ url()->previous() }} class="my-4 btn btn-secondary"> Volver</a>
        <button type="submit" class="my-4 btn btn-success"> Guardar</button>
    </form>
</div>

<script>
    //calcular precio total reserva: num personas * precio viaje seleccionado
    document.addEventListener('DOMContentLoaded', function() {
                var numPaxInput = document.getElementById('num_pax');
                var viajeSelect = document.getElementById('id_viaje');
                var precioTotalInput = document.getElementById('precio_total');
        //llamar a la funcion de inicio para editar reserva donde ya hay un precio
                calcularPrecioTotal();
                function calcularPrecioTotal() {
                    var numPax = parseFloat(numPaxInput.value);
                    var precioPersona = parseFloat(viajeSelect.options[viajeSelect.selectedIndex].getAttribute(
                        'precio_persona'));

                    if (!isNaN(numPax)) {
                        var precioTotal = numPax * precioPersona;
                        precioTotalInput.textContent = precioTotal.toFixed(2) + '€';
                    } else {
                        precioTotalInput.textContent = '0.00€';
                    }
                }
                // Agregar event listeners
        numPaxInput.addEventListener('change', calcularPrecioTotal);
        viajeSelect.addEventListener('change', calcularPrecioTotal);

        // Llamar a la función calcularPrecioTotal() para inicializar el valor del precio total
        calcularPrecioTotal();
    })
</script>
