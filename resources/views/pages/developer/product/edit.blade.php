@extends('layouts.template')

@section('title')
<div>
	<h2>Welcome Developer</h2>
</div>
@endsection

@section('content')
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">Edit Produk</h3>
	</div>
	<!-- /.card-header -->

	<div class="card-body" style="margin-top: -10px">
		<form action = "{{route('product.update', $product->id)}}" method="POST">
			@csrf
            @method('PUT')
				<div class="card-body">
					<div class="form-group">
						<label>Nama Produk</label>
						<input type="text" class="form-control" placeholder="Masukkan nama produk" name="nama" value="{{ $product->nama }}">
					</div>
					<div class="form-group">
						<label>Kategori</label>
						<select class="form-control select2bs4" name="kategori" style="width: 100%;">
							<option value="Kue Asin" {{ $product->kategori == "Kue Asin" ? 'selected' : '' }}>Kue Asin</option>
							<option value="Kue Manis" {{ $product->kategori == "Kue Manis" ? 'selected' : '' }}>Kue Manis</option>
							<option value="Kotak" {{ $product->kategori == "Kotak" ? 'selected' : '' }}>Kotak</option>							
						</select>
					</div>
					<div class="form-group">
						<label>Varian</label>
						<select class="form-control select2bs4" name="varian" style="width: 100%;">
							<option value="Normal" {{ $product->varian == "Normal" ? 'selected' : '' }}>Normal</option>
							<option value="Mini" {{ $product->varian == "Mini" ? 'selected' : '' }}>Mini</option>
							<option value="Pendek" {{ $product->varian == "Pendek" ? 'selected' : '' }}>Pendek</option>
							<option value="Tinggi" {{ $product->varian == "Tinggi" ? 'selected' : '' }}>Tinggi</option>
						</select>
					</div>
					<div class="form-group">
						<label>Harga Satuan</label>
						<input type="number" class="form-control" placeholder="Masukkan Harga Satuan" name="harga_satuan" value="{{ $product->harga_satuan }}">
					</div>
					<a href="{{ route('product.index') }}" type="button" class="btn mt-3 btn-outline-primary">Kembali</a>
					<button class="btn btn-primary mt-3" type="submit">Tambah</button>
				</div>
		</form>
	</div>
	<!-- /.card-body -->
</div>
@endsection