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

{{-- Customer Bio --}}
<div class="my-4 card" style="padding: 20px">
	<div class="card-header">
		<h2>Customer Data</h2>
	</div>
	<div class="card-body">
			<h5 class = "customer-bio"><b>No Order : {{$order->id}}</b></h5>
			<h5 class = "customer-bio"><b>Nama     : {{$order->nama_pemesan}}</b></h5>
			<h5 class = "customer-bio">Telepon : {{$order->telepon}}</h5>
			<h5 class = "customer-bio">Alamat : {{$order->alamat}}</h5>
			<h5 class = "customer-bio">Metode Pengiriman : {{$order->metode_pengiriman}}</h5>
			<h5 class = "customer-bio">Tanggal Pengiriman : {{$order->tanggal_kirim}}</h5>
			<h5 class = "customer-bio">Waktu Pengiriman : {{$order->jam_kirim}}</h5>
		<div class="row mt-4" style="gap: 20px">
			@if($order->status_pengiriman === "Belum Dikirim")
					<div style="background: rgb(241, 155, 155); border-radius: 50px; padding: 5px 10px"><i class = "far fa-clock"></i> Belum Dikirim</div>
			@else
					<div style="background: rgb(186, 241, 155); border-radius: 50px; padding: 5px 10px"><i class="fas fa-check"></i> Terkirim</div>
			@endif

			@if($order->status_pembayaran === "Belum Lunas")
			<div style="background: rgb(241, 155, 155); border-radius: 50px; padding: 5px 10px"><i class="far fa-times-circle"></i> Belum Lunas</div>
			@else
			<div style="background: rgb(186, 241, 155); border-radius: 50px; padding: 5px 10px"><i class="fas fa-check"></i>
				Lunas</div>
			@endif

			@if($order->status_pemesanan === "Dibatalkan")
			<div style="background: rgb(241, 155, 155); border-radius: 50px; padding: 5px 10px"><i class="far fa-times-circle"></i> Dibatalkan</div>
			@elseif($order->status_pemesanan === "Diproses")
			<div style="background: rgb(241, 225, 155); border-radius: 50px; padding: 5px 10px"><i class="far fa-clock"></i> Diproses</div>
			@else
			<div style="background: rgb(186, 241, 155); border-radius: 50px; padding: 5px 10px"><i class="fas fa-check"></i>
				Selesai</div>
			@endif
		</div>
	</div>

</div>


{{--- Tabel Pesanan ---}}
<div class="my-5">
	@include('layouts.messageAlert')
	<h2>Daftar Pesanan</h2>
	<table class="table table-bordered text-center" style="background-color:white">
		<thead>
			<tr class="bg-primary">
				<th>No</th>
				<th>Nama Pesanan</th>
				<th>Jumlah</th>
				<th>Keterangan</th>
				<th>Harga Satuan</th>
			</tr>
		</thead>
		<tbody>
			@php $no = 1 @endphp
			@foreach($orderDetails as $orderDetail)
			<tr>
				<td>{{$no++}}</td>
				<td>{{$orderDetail->product->nama . ' ' . $orderDetail->product->varian}}</td>
				<td>{{$orderDetail->kuantitas}}</td>
				<td>{{$orderDetail->keterangan}}</td>
				<td>{{$orderDetail->product->harga_satuan}}</td>
			</tr>
			@endforeach
			<tr class="font-weight-bold">
				<td colspan=4>Total</td>
				<td>{{ $order->total_harga_pesanan }}</td>
			</tr>
		</tbody>
	</table>
	<a href={{route('cetakNotaPemesanan', $order->id)}}><button class="btn my-1" style="background: rgb(57, 57, 168); color:white"><i class="fas fa-print"></i>   Cetak Nota
			Pemesanan</button></a>
</div>


{{-- Tabel Pembayaran --}}

<div class="pb-5">
	@include('layouts.messageAlert')
	<h2>Data Pembayaran</h2>
	<table class="table table-bordered text-center" style="background-color:white">
		<thead>
			<tr class="bg-primary">
				<th>No</th>
				<th>No Nota</th>
				<th>Tanggal Pembayaran</th>
				<th>Nominal</th>
				<th>Metode Transaksi</th>
				<th>Foto Bukti</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			@php $no = 1 @endphp
			@foreach($pemasukan as $pemasukan)
			<tr>
				<td>{{$no++}}</td>
				<td>{{$pemasukan->no_nota}}</td>
				<td>{{$pemasukan->tanggal_bayar}}</td>
				<td>{{$pemasukan->nominal}}</td>
				<td>{{$pemasukan->metode_transaksi}}</td>
				<td>
					@if($pemasukan->metode_transaksi === 'Cash')
					<p>-</p>
					@else
					@if($pemasukan->foto_bukti == null)
					<p>Foto bukti belum diunggah</p>
					@else
					<a href="{{route('previewFoto', $pemasukan->id)}}" target="_blank" class="btn btn-success">Preview</a>
					@endif
					@endif
				</td>
				<td><a href="{{route('cetakNotaPembayaran', $pemasukan->id)}}" class="btn btn-primary"><i class="fas fa-print"></i>  Cetak</a></td>
			</tr>
			@endforeach
			<tr class="font-weight-bold">
				<td colspan=6>Total</td>
				<td>{{ $nominal}}</td>
			</tr>
		</tbody>
	</table>
	<a href="{{route('cetakNotaKeseluruhan', $order->id)}}"><button class="btn my-1" style="background: rgb(57, 57, 168); color:white"><i class = "fas fa-print"></i>   Cetak Nota
			Keseluruhan</button></a>
</div>


@endsection