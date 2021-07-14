@extends('layouts.template')

@section('title')
<div class="row justify-content-center align-content-center">
	<div class="col">
		<h2>Data Pemesanan Kue</h2>
	</div>
	<div class="col justify-content-end">
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Cari..." aria-label="cari" aria-describedby="button-addon2">
			<div class="input-group-append">
				<button class="btn btn-outline-secondary" type="button" id="button-addon2"> <i
						class="fas fa-search"></i></button>
			</div>
			<a href="{{ route('order.create') }}"><button class="btn btn-primary ml-2" type="button" id="button-addon2">+
					Tambah Pesanan</button></a>
		</div>
	</div>
</div>
@endsection

@section('content')
{{-- Table --}}
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h2 class="card-title">Tabel Daftar Pesanan</h2>
				<div class="card-tools">
					<div class="input-group input-group-sm" style="width: 300px; height: 40px">
						<input type="text" name="search" style="height: 40px" class="form-control float-right" placeholder="Search">

						<div class="input-group-append">
							<button type="submit" class="btn btn-info">
								<i class="fas fa-search"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body table-responsive p-0">
				<table class="table table-hover text-center" id="productTable">
					<thead>
						<tr>
							<th>No</th>
							<th>No. Nota</th>
							<th>Nama Pemesan</th>
							<th>Tanggal Pesan</th>
							<th>Tanggal Kirim</th>
							<th>Jam Kirim</th>
							<th>Status Pembayaran</th>
							<th>Status Pengiriman</th>
							<th>Metode Pengiriman</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@php $no = 1 @endphp
						@foreach($orders as $order)
						<tr>
							<td>{{$no++}}</td>
							<td>{{$order->id}}</td>
							<td>{{$order->nama_pemesan}}</td>
							<td>{{$order->tanggal_pesan}}</td>
							<td>{{$order->tanggal_kirim}}</td>
							<td>{{$order->jam_kirim}}</td>
							<td>{{$order->status_pembayaran}}</td>
							<td>{{$order->status_pengiriman}}</td>
							<td>{{$order->metode_pengiriman}}</td>
							<td>
								<a type="button" href="{{ route('order.show', $order->id) }}" class="btn btn-primary">Detail</a>
								@if($order->status_pengiriman != "Dibatalkan")
								<a type="button" href="{{ route('order.edit', $order->id) }}" class="btn btn-warning"><i class="fa fa-edit" style="color: white"></i></a>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
</div>
@endsection