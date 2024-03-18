@extends('layout/template')
@section('title', 'Editar Reserva')

@section('content')
    <main>
        <div class="container py-4">
            <h2 class="py-4">Editar Reserva</h2>

            @include('reservas.form')
    @endsection
