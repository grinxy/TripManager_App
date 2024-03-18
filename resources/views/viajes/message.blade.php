@extends('layout/template')
@section('title', 'Nuevo Viaje creado')

@section('content')
    <main>
        <div class="container py-4">
            <h2> {{ $msg }}</h2>
            <a href="{{ url('viajes') }}" class="btn btn-secondary mt-1 px-5"> Volver </a>
        </div>
    </main>
@endsection
