@extends('layout/template')
@section('title', 'Nueva Reserva')

@section('content')
    <main>
        <div class="container py-4">
            <h2> {{ $msg }}</h2>
            <a href="" onclick="goBack()" class="btn btn-secondary"> Volver </a>
        </div>
    </main>
    <script>
        function goBack() {
            window.history.go(-2); // Retrocede dos páginas en el historial del navegador
            location.reload(); // Recarga la página actual para incluir modificaciones hechas del form
        }
    </script>
@endsection
