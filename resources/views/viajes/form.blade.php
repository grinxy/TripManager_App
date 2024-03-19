

@if ($errors->any())
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error en los datos introducidos</strong> Por favor revísalos y vuelve a enviar el formulario

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="container">
    <div class="col-12">
        <form action="{{ isset($viaje) ? url('viajes/' . $viaje->id) : url('viajes') }}" method="post">
            @csrf
            @if(isset($viaje))
                @method('PUT')
            @endif
            <div class="mb-3 row">
                <label for="nombre" class="col-sm-2 col-form-label">Nombre del Viaje</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="nombre" id="nombre" value="{{ isset($viaje) ? $viaje->nombre : old('nombre') }}" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="fecha_salida" class="col-sm-2 col-form-label">Fecha de Salida</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" placeholder=" " id="fecha_salida" name="fecha_salida"
                        min="<?php echo date('Y-m-d'); ?>" value="{{isset($viaje) ? $viaje->fecha_salida : old('fecha_salida') }}" required value =" "
                        onchange="setMinDate()">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="fecha_regreso" class="col-sm-2 col-form-label">Fecha de Regreso</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" placeholder=" " id="fecha_regreso" name="fecha_regreso"
                        min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" value="{{ isset($viaje) ? $viaje->fecha_regreso : old('fecha_regreso') }}" required value =" ">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="num_pax" class="col-sm-2 col-form-label">Destino</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="destino" id="destino"
                        value="{{isset($viaje) ? $viaje->destino : old('destino') }}" required>

                </div>
            </div>
            <div class="mb-3 row">
                <label for="precio_persona" class="col-sm-2 col-form-label">Precio/persona</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" name="precio_persona" id="precio_persona" placeholder="€"
                        value="{{isset($viaje) ? $viaje->precio_persona : old('precio_persona') }}" required>

                </div>
            </div>
            <div class="mb-3 row">
                <label for="num_pax" class="col-sm-2 col-form-label">Numero Viajeros</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" name="num_pax" id="num_pax"
                        value="{{isset($viaje) ? $viaje->num_pax : old('num_pax') }}" required>

                </div>
            </div>
            <div class="mb-3 row">
                <label for="estado" class="col-sm-2 col-form-label">Estado viaje</label>
                <div class="col-sm-5">
                    <p> {{ isset($viaje)? $viaje->estado : 'No confirmado' }}</p>

                </div>
            </div>
            <div class="mb-3 row">
                <label for="imagen" class="col-sm-2 col-form-label">Imagen</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="imagen" id="imagen"
                        placeholder="URL de la imagen" value="{{isset($viaje) ? $viaje->imagen : old('imagen') }}" required>

                </div>
            </div>

            <a href="javascript:history.go(-1)" class="my-4 btn btn-secondary"> Volver</a>
            <button type="submit" class="my-4 btn btn-success"> Guardar</button>
        </form>
    </div>
</div>
<script>
    function setMinDate() {
        var fechaSalida = document.getElementById('fecha_salida').value;
        var fechaRegreso = document.getElementById('fecha_regreso');
        var fechaSalidaFormato = new Date(fechaSalida); //convertir entrada a formato fecha YYY-MM-DD

        // fecha mínima para la fecha de regreso + un día de la fecha de salida seleccionada
        fechaRegreso.min = fechaSalidaFormato.toISOString().split('T')[
            0]; //toISO --> fomato fecha(T) + Hora(Z). Cogemos el elemento 0 del array para tener la fecha
    }
</script>
