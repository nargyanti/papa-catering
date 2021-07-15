@extends('layouts.template')

@section('title')
<div>
	<h2>Data Pengeluaran Baru</h2>
</div>
@endsection

@section('content')


<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">Masukkan Data Pengeluaran Baru</h3>
	</div>
	<!-- /.card-header -->

	<div class="card-body" style="margin-top: -10px">
		<form action="{{route('pengeluaran.store')}}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="card-body">
				<div class="form-group">
					<label for="exampleInputEmail1">Tanggal Pengeluaran</label>
					<input type="date" class="form-control" placeholder="Masukkan tanggal pengeluaran" name="tanggal_pengeluaran">
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Jenis Beban</label>
					<input type="text" class="form-control" placeholder="Masukkan nominal" name="jenis_beban">
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Jenis Pengeluaran</label>
					<input type="text" class="form-control" placeholder="Masukkan nominal" name="jenis_pengeluaran">
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Nominal</label>
					<input type="text" class="form-control" placeholder="Masukkan nominal" name="nominal">
				</div>
				<div class="form-group">
					<label>Metode Transaksi</label>
					<select class="form-control select2bs4" name="metode_transaksi" style="width: 100%;">
						<option value="Transfer">Transfer</option>
						<option value="Cash">Cash</option>
					</select>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Upload Foto Bukti Pembayaran</label>
					<input type="file" class="form-control" id="exampleInputPassword1" placeholder="upload foto bukti" name="foto_bukti">
				</div>
				<div class="form-group">
					<label>keterangan</label>
					<textarea class="form-control" rows="3" name="keterangan" placeholder="Masukkan Keterangan"></textarea>
				</div>
				<a href="{{route('pengeluaran.index')}}" type="button" class="btn mt-3 btn-outline-primary">Kembali</a>
				<button class="btn btn-primary mt-3">Tambah</button>
			</div>
		</form>
	</div>
	<!-- /.card-body -->
</div>
@endsection