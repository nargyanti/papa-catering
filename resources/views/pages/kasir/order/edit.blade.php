@extends('layouts.template')

@section('title')
<div>
	<h2>Edit Pesanan</h2>
</div>
@endsection

@section('content')
@include('layouts.errorAlert')
<a href="{{ route('kasir.index') }}"><button type="button" class="btn btn-outline-primary">Kembali</button></a>
<form action="{{ route('order.update', $order->id) }}" method="POST">
    @csrf
    @method('PUT')    
    <div class="form-group">
        <label>Nama Pemesan</label>
        <input type="text" class="form-control" placeholder="Masukkan nama pemesan" name="nama_pemesan" value="{{ $order->nama_pemesan }}">        
    </div>
    <div class="form-group">
        <label>No. Telepon</label>
        <input type="text" class="form-control" placeholder="Masukkan nomor telepon" name="telepon" value="{{ $order->telepon }}">        
    </div>
    <div class="form-group">
        <label>Tanggal Kirim</label>
        <input type="date" class="form-control" placeholder="dd/mm/yyyy" name="tanggal_kirim" value="{{ $order->tanggal_kirim }}">        
    </div>
    <div class="form-group">
        <label>Jam Kirim</label>
        <input type="time" class="form-control" name="jam_kirim" value="{{ $order->jam_kirim }}">
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <textarea class="form-control" rows="3" name="alamat" placeholder="Masukkan alamat">{{ $order->alamat }}</textarea>
    </div>
    <div class="form-group">
        <label>Keterangan</label>
        <textarea class="form-control" rows="3" name="keterangan" placeholder="Masukkan keterangan">{{ $order->keterangan }}</textarea>
    </div>
    <div class="form-group">
        <label>Status Pengiriman</label>
        <select class="form-control" name="status_pengiriman" style="width: 100%;">
            <option value="Belum Terkirim" {{ $order->status_pengiriman == "Belum Terkirim" ? 'selected' : '' }}>Belum Terkirim</option>            
            <option value="Terkirim" {{ $order->status_pengiriman == "Terkirim" ? 'selected' : '' }}>Terkirim</option>                        
        </select>
	</div>    
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#batalOrder">Batalkan Pesanan</button>
    <button type="submit" class="btn btn-primary">Simpan</button>    
</form>

{{-- Modal Batal Order--}}
<div class="modal fade" id="batalOrder" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Batalkan Pemesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>            
            <div class="modal-body">
                <p class="text-center"><i class="far fa-times-circle" style="font-size:100px; color: #e86464"></i></p>
                <p class="text-center" style="font-size:20px; color: #e86464">
                    Yakin untuk membatalkan pemesanan ini?
                </p>													                             
            </div>
            <div class="modal-footer">                
                <a type="button" class="btn btn-outline-primary" data-dismiss="modal">Tidak</a>
                <form action="{{ route('order.batal', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')         
                    <button type="submit" class="btn btn-primary">Ya, Batalkan</button>
                </form>                 
            </div>            
        </div>
    </div>
</div>

<a href="#"><button type="button" class="btn btn-primary mt-5">Edit Pesanan</button></a>
<table>
    <th>Tes</th>
    <tr>
        <td>Tes juga</td>
    </tr>
</table>

<a href="{{ route('pemasukan.create') }}"><button type="button" class="btn btn-primary mt-5">Tambah Pembayaran</button></a>
<table>
    <th>Tes</th>
    <tr>
        <td>Tes juga</td>
    </tr>
</table>
@endsection