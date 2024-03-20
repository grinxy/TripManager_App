@extends('layout/template')
@section('title', 'Trip Manager | Viajes')

@section('content')
    <section class="ftco-section bg-light">
        <div class="container">

            <div class="row justify-content-center py-5 mb-3">
                <div class="col-md-7 heading-section text-center ftco-animate fadeInUp ftco-animated">
                    <h1> Bienvenido a tu gestor de reservas y viajes</h1>
                </div>
            </div>
            <div class="row justify-content-center pb-5 mb-3">
                <div class="col-md-7 heading-section text-center ftco-animate fadeInUp ftco-animated">
                    <a href="{{ url('viajes/') }}" class="btn btn-info mt-1 mx-3 px-5 text-white">Ir a Viajes</a>
                    <a href="{{ url('reservas/') }}" class="btn btn-success mt-1 mx-3 px-5">Ir a Reservas</a>


                @endsection
