@extends('layouts.template')

@section('title')
<div class="row justify-content-center align-content-center">
	<div class="col">
		<h2>Data Pemesanan Kue > Lihat Detail</h2>
	</div>	
</div>
@endsection

@section('content')
<a href="{{ route('kasir.index') }}"><button class="btn btn-primary">Kembali</button></a>
<a href=#><button class="btn btn-primary">Cetak Nota Pemesanan</button></a>
<a href="#"><button class="btn btn-primary">Cetak Nota Keseluruhan</button></a>
@endsection