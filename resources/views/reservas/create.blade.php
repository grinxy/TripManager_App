@extends('layout/template')
@section('title', 'Nueva Reserva')

@section('content')
    <main>
        <div class="container py-4">
            <h2 class="py-4">Crear nueva Reserva</h2>

            @include('reservas.form')
@endsection
