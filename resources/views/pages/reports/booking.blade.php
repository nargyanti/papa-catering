@extends('layouts.template')

@section('title')
    <div class="row justify-content-center align-content-center">
        <div class="col">
            <h2>Data Pemesanan Kue</h2>
        </div>
        <div class="col justify-content-end">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari..." aria-label="cari" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2"> <i class="fas fa-search"></i></button>
                </div>
                <button class="btn btn-primary ml-2" type="button" id="button-addon2">+ Tambah Pesanan</button>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <h1>Booking gass...</h1>
@endsection
