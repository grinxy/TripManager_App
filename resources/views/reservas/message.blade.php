@extends('layout/template')
@section('title', 'Nueva Reserva')

@section('content')
    <main>
        <div class="container py-4">
            <h2> {{ $msg }}</h2>
            <a href="{{ url('reservas') }}" class="btn btn-secondary"> Volver </a>
        </div>
    </main>
@endsection
