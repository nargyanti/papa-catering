@extends('layouts.template')

@section('title')
<div>
	<h2>Update Data Pengeluaran </h2>
</div>
@endsection

@section('content')


<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">Id Pengeluaran<span style="font-weight: bold">{{$pengeluaran->id}}</span></h3>
	</div>
	<!-- /.card-header -->

	<div class="card-body" style="margin-top: -10px">
		<form action="{{route('pengeluaran.update', $pengeluaran->id)}}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="card-body">
				<input type="hidden" class="form-control" name="id" value="{{$pengeluaran->id}}">
				<div class="form-group">
					<label for="exampleInputEmail1">Tanggal Pengeluaran</label>
					<input type="date" class="form-control" placeholder="Masukkan tanggal pengeluaran" name="tanggal_pengeluaran" value="{{$pengeluaran->tanggal_pengeluaran}}">
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Jenis Beban</label>
					<input type="text" class="form-control" placeholder="Masukkan jenis beban" name="jenis_beban" value="{{$pengeluaran->jenis_beban}}">
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Jenis Pengeluaran</label>
					<input type="text" class="form-control" placeholder="Masukkan jenis pengeluaran" name="jenis_pengeluaran" value="{{$pengeluaran->jenis_pengeluaran}}">
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Nominal</label>
					<input type="text" class="form-control" placeholder="Masukkan nominal" name="nominal" value="{{$pengeluaran->nominal}}">
				</div>
				<div class="form-group">
					<label>Metode Transaksi</label>
					<select class="form-control select2bs4" name="metode_transaksi" style="width: 100%;">
						<option value="Transfer" {{$pengeluaran->metode_transaksi === 'Transfer' ? 'selected' : ''}}>Transfer</option>
						<option value="Cash" {{$pengeluaran->metode_transaksi === 'Cash' ? 'selected' : ''}}>Cash</option>
					</select>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Upload Foto Bukti Pembayaran</label>
					<input type="file" class="form-control" id="exampleInputPassword1" placeholder="upload foto bukti"
						name="foto_bukti">
					<img src="{{asset('storage/'.$pengeluaran->foto_bukti) }}" width="200px">
				</div>
				<div class="form-group">
					<label>keterangan</label>
					<textarea class="form-control" rows="3" name="keterangan" placeholder="Masukkan Keterangan">{{$pengeluaran->keterangan}}</textarea>
				</div>
				<a href="{{route('pengeluaran.index')}}" type="button" class="btn mt-3 btn-outline-primary">Kembali</a>
				<button class="btn btn-primary mt-3">Tambah</button>
			</div>
		</form>
	</div>
	<!-- /.card-body -->
</div>
@endsection