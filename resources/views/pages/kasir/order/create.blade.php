@extends('layouts.template')

@section('title')
<div>
	<h2>Tambah Pesanan</h2>
</div>
@endsection

@section('content')
@include('layouts.errorAlert')
<form action="{{ route('order.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Nama Pemesan</label>
        <input type="text" class="form-control" placeholder="Masukkan nama pemesan" name="nama_pemesan">        
    </div>
    <div class="form-group">
        <label>No. Telepon</label>
        <input type="text" class="form-control" placeholder="Masukkan nomor telepon" name="telepon">        
    </div>
    <div class="form-group">
        <label>Tanggal Pesan</label>
        <input type="date" class="form-control" placeholder="dd/mm/yyyy" name="tanggal_pesan">        
    </div>
    <div class="form-group">
        <label>Tanggal Kirim</label>
        <input type="date" class="form-control" placeholder="dd/mm/yyyy" name="tanggal_kirim">        
    </div>
    <div class="form-group">
        <label>Jam Kirim</label>
        <input type="time" class="form-control" name="jam_kirim">        
    </div>
    <div class="form-group">
        <label>Example textarea</label>
        <textarea class="form-control" rows="3" name="alamat" placeholder="Masukkan alamat"></textarea>
    </div>
    <a href="{{ route('kasir.index') }}"><button type="button" class="btn btn-outline-primary">Kembali</button></a>
    <button type="submit" class="btn btn-primary">Selanjutnya</button>
</form>
@endsection