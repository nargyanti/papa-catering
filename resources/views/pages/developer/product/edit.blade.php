@extends('layouts.template')

@section('title')
<div>
	<h2>Edit Produk</h2>
</div>
@endsection

@section('content')
@include('layouts.errorAlert')
<form action="{{route('product.update', $product->id)}}" method="POST" class="pt-4 px-3">
	@csrf		
	<div class="row">
		<div class="form-group col-12">
			<label>Nama Produk</label>
			<input type="text" class="form-control" placeholder="Masukkan nama produk" name="nama" value="{{ $product->nama }}" required>
		</div>
		<div class="form-group col-6">
			<label>Kategori</label>
			<select class="form-control select2bs4" name="kategori" style="width: 100%;" required>
				<option value="Kue Asin" {{ $product->kategori == "Kue Asin" ? 'selected' : '' }}>Kue Asin</option>
				<option value="Kue Manis" {{ $product->kategori == "Kue Manis" ? 'selected' : '' }}>Kue Manis</option>
				<option value="Kotak" {{ $product->kategori == "Kotak" ? 'selected' : '' }}>Kotak</option>							
			</select>
		</div>
		<div class="form-group col-6">
			<label>Varian</label>
			<select class="form-control select2bs4" name="varian" style="width: 100%;" required>
				<option value="Normal" {{ $product->varian == "Normal" ? 'selected' : '' }}>Normal</option>
				<option value="Mini" {{ $product->varian == "Mini" ? 'selected' : '' }}>Mini</option>
				<option value="Pendek" {{ $product->varian == "Pendek" ? 'selected' : '' }}>Pendek</option>
				<option value="Tinggi" {{ $product->varian == "Tinggi" ? 'selected' : '' }}>Tinggi</option>
			</select>
		</div>
		<div class="form-group col-12">
			<label>Harga Satuan</label>
			<input type="number" class="form-control" placeholder="Masukkan Harga Satuan" name="harga_satuan" value="{{ $product->harga_satuan }}" required>
		</div>
	</div>
	<div class="mt-3">					
		<a href="{{ route('product.index') }}" type="button" class="btn btn-outline-primary mr-3" style="width:150px">Kembali</a>
		<button class="btn btn-primary" type="submit" style="width:150px">Simpan</button>
	</div>
</form>
@endsection