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
@include('layouts.messageAlert')
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
							<th>Nota</th>
							<th>Pemesan</th>
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
							<td>{{$order->id}}</td>
							<td>{{$order->nama_pemesan}}</td>
							<td>{{$order->tanggal_pesan}}</td>
							<td>{{$order->tanggal_kirim}}</td>
							<td>{{$order->jam_kirim}}</td>
							<td>{{$order->status_pembayaran}}</td>
							<td>{{$order->status_pengiriman}}</td>
							<td>{{$order->metode_pengiriman}}</td>
							<td>
								<a type="button" href="{{ route('order.show', $order->id) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
								@if($order->status_pemesanan == "Diproses")
								<a type="button" href="{{ route('order.edit', $order->id) }}" class="btn btn-warning"><i class="fa fa-edit" style="color: white"></i></a>
								<a type="button" href="{{ route('order.show', $order->id) }}" class="btn btn-success" data-toggle="modal" data-target="#selesaiOrder"><i class="fas fa-check"></i></a>
								@endif
							</td>
						</tr>
						{{-- Modal Selesai Order--}}
						<div class="modal fade" id="selesaiOrder" tabindex="-1" role="dialog">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Tandai Pemesanan sebagai Selesai</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
												aria-hidden="true">&times;</span></button>
									</div>            
									<div class="modal-body">
										<p class="text-center"><i class="far fa-check-circle" style="font-size:100px; color: #218838"></i></p>
										<p class="text-center" style="font-size:20px; color: #218838">
											Yakin untuk menandai pemesanan ini sebagai selesai?
										</p>													                             
									</div>
									<div class="modal-footer">                
										<a type="button" class="btn btn-outline-primary" data-dismiss="modal">Tidak</a>
										<form action="{{ route('order.selesai', $order->id) }}" method="POST">
											@csrf
											@method('PUT')         
											<button type="submit" class="btn btn-primary">Ya, Tandai</button>
										</form>                 
									</div>            
								</div>
							</div>
						</div>
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