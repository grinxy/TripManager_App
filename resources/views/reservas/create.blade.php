@extends('layout/template')
@section('title', 'Nueva Reserva')

@section('content')
    <main>
        <div class="container py-4">
            <h2 class="py-4">Crear nueva Reserva</h2>

            @include('reservas.form')
            <script>
                //calcular precio total reserva: num personas * precio viaje seleccionado
                document.addEventListener('DOMContentLoaded', function() {
                    var numPaxInput = document.getElementById('num_pax');
                    var viajeSelect = document.getElementById('id_viaje');





                    function calcularPlazasDisponibles() {
                        var selectedOption = viajeSelect.options[viajeSelect.selectedIndex];
                        plazasDisponiblesValue = parseFloat(selectedOption.getAttribute('data-plazas-disponibles'));
                        numPaxInput.setAttribute('max', plazasDisponiblesValue);

                        if (isNaN(plazasDisponiblesValue)) {
                            document.getElementById('plazas_disponibles').textContent = 'Plazas disponibles: ';
                        } else {
                            document.getElementById('plazas_disponibles').textContent = 'Plazas disponibles: ' +
                                plazasDisponiblesValue;
                        }


                    }

                    //evento para cuando el select cambie y el viaje y viajeros esten definidos

                    viajeSelect.addEventListener('change', calcularPlazasDisponibles);
                    calcularPlazasDisponibles();

                });
            </script>
@endsection
