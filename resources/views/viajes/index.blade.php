@extends('layout/template')
@section('title', 'Trip Manager | Viajes')

@section('content')

    <section class="ftco-section bg-light">
        <div class="container">

            <div class="row justify-content-center py-5 mb-3">
                <div class="col-md-7 heading-section text-center ftco-animate fadeInUp ftco-animated">
                    <h2>Viajes Disponibles</h2>
                </div>
                <div class="row mt-5">
                    <div class="col-md-7">
                        <form action="{{ route('viajes.index') }}" method="GET">
                            @csrf
                            <div class="input-group">
                                <!-- Filtrar por destino-->
                                <select name="destino_buscado" id="destino_buscado" class="form-select" style="width: 400px;">
                                    <option value="">Filtrar por destino (todos)</option>
                                    @foreach ($viajes_select as $viaje)
                                        <option value="{{ $viaje->destino }}">{{ $viaje->destino }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary" data-mdb-ripple-init><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5 text-end">
                        <a href="{{ url('viajes/create') }}" class="btn btn-success mt-1 px-5">Crear Viaje</a>
                    </div>
                </div>

            </div>
            <div class="row">
                @foreach ($viajes as $viaje)

                        <div class="col-md-4 ftco-animate fadeInUp ftco-animated destino">
                            <div class="card block-7 bg-light mb-5">
                           <!-- <div class="block-7">-->
                                <div style="height: 180px; overflow: hidden;">
                                    <img src="{{ $viaje->imagen }}" alt="{{ $viaje->nombre }}" style="width: 100%;">
                                </div>
                                <div class="text-center p-4">
                                    <h3 class="excerpt d-block">{{ $viaje->nombre }}</h3>
                                    <span class="price"><sup>€</sup> <span
                                            class="number">{{ $viaje->precio_persona }}</span>
                                        <sub>/persona</sub></span>
                                    <ul class="data-text my-5">
                                        <p><strong>Salida:</strong>{{ $viaje->fecha_salida }}</p>
                                        <p><strong>Regreso:</strong> {{ $viaje->fecha_regreso }}</p>
                                        <p><strong>Destino:</strong> {{ $viaje->destino }}</p>
                                        <p><strong>Plazas Máximas:</strong>{{ $viaje->num_pax }}</p>
                                    </ul>
                                    <a href="{{ url('viajes/' . $viaje->id . '/show') }}"
                                        class="btn btn-primary px-5 py-2">Gestionar</a>
                                </div>
                            </div>
                        </div>

                @endforeach
            </div>
        </div>
    </section>
@endsection
