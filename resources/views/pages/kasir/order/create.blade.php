@extends('layouts.template')

@section('title')
<div>
	<h2>Tambah Pesanan</h2>
</div>
@endsection

@section('content')
@include('layouts.errorAlert')
<form action="{{ route('order.store') }}" method="POST" class="p-2">
    @csrf
    <div class="row">     
        <div class="form-group col-6">
            <label>Nama Pemesan</label>
            <input type="text" class="form-control" placeholder="Masukkan nama pemesan" name="nama_pemesan">        
        </div>
        <div class="form-group col-6">
            <label>No. Telepon</label>
            <input type="text" class="form-control" placeholder="Masukkan nomor telepon" name="telepon">        
        </div>
        <div class="form-group col-4">
            <label>Tanggal Pesan</label>
            <input type="date" class="form-control" placeholder="dd/mm/yyyy" name="tanggal_pesan">        
        </div>
        <div class="form-group col-4">
            <label>Tanggal Kirim</label>
            <input type="date" class="form-control" placeholder="dd/mm/yyyy" name="tanggal_kirim">        
        </div>
        <div class="form-group col-4">
            <label>Jam Kirim</label>
            <input type="time" class="form-control" name="jam_kirim">        
        </div>
        <div class="form-group col-6">
            <label>Alamat</label>
            <textarea class="form-control" rows="4" name="alamat" placeholder="Masukkan alamat"></textarea>
        </div>
    </div>
    <div>
        <a href="{{ route('kasir.index') }}"><button type="button" class="btn btn-outline-primary mr-3" style="width:150px">Kembali</button></a>
        <button type="submit" class="btn btn-primary" style="width:150px">Selanjutnya</button>
    </div>    
</form>
@endsection