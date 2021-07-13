@extends('layouts.template')

@section('title')
<div>
	<h2>Welcome Developer</h2>
</div>
@endsection

@section('content')
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">Tambah Produk Baru</h3>
	</div>
	<!-- /.card-header -->

	<div class="card-body" style="margin-top: -10px">
		<form action = "{{route('product.store')}}" method="POST">
			@csrf
				<div class="card-body">
					<div class="form-group">
						<label>Nama Produk</label>
						<input type="text" class="form-control" placeholder="Masukkan nama produk" name="nama">
					</div>
					<div class="form-group">
						<label>Kategori</label>
						<select class="form-control select2bs4" name="kategori" style="width: 100%;">
							<option value="Kue Asin">Kue Asin</option>
							<option value="Kue Manis">Kue Manis</option>
							<option value="Kotak">Kotak</option>							
						</select>
					</div>
					<div class="form-group">
						<label>Varian</label>
						<select class="form-control select2bs4" name="varian" style="width: 100%;">
							<option value="Normal">Normal</option>
							<option value="Mini">Mini</option>
							<option value="Pendek">Pendek</option>
							<option value="Tinggi">Tinggi</option>
						</select>
					</div>
					<div class="form-group">
						<label>Harga Satuan</label>
						<input type="number" class="form-control" placeholder="Masukkan Harga Satuan" name="harga_satuan">
					</div>
					<a href="{{ route('product.index') }}" type="button" class="btn mt-3 btn-outline-primary">Kembali</a>
					<button class="btn btn-primary mt-3" type="submit">Tambah</button>
				</div>
		</form>
	</div>
	<!-- /.card-body -->
</div>
@endsection