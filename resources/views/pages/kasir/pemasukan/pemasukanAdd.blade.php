@extends('layouts.template')

@section('title')
<div>
	<h2>Data Pemasukan Baru</h2>
</div>
@endsection

@section('content')


<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">Masukkan Data Pemasukan Baru</h3>
	</div>
	<!-- /.card-header -->

	<div class="card-body" style="margin-top: -10px">
		<form action="{{route('pemasukan.store')}}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="card-body">
				<div class="form-group">
					<label for="exampleInputEmail1">No Nota</label>
					<input type="text" class="form-control" placeholder="Masukkan no nota" name="order_id">
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Tanggal Pembayaran</label>
					<input type="date" class="form-control" placeholder="Masukkan tanggal pembayaran" name="tanggal_bayar">
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
				<a href="{{route('pemasukan.index')}}" type="button" class="btn mt-3 btn-outline-primary">Kembali</a>
				<button class="btn btn-primary mt-3">Tambah</button>
			</div>
		</form>
	</div>
	<!-- /.card-body -->
</div>
@endsection