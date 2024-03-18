@extends('layout/template')
@section('title', 'Nueva Reserva')

@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center py-5 mb-3">
                <h2 class="py-4">Editar Viaje existente</h2>


                @include('viajes.form')


            </div>
        </div>
    </main>


@endsection
