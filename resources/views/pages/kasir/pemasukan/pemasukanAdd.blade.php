@extends('layouts.template')

@section('title')
<div>
	<h2>Data Pembayaran Baru</h2>
</div>
@endsection

@section('content')
		<form action="{{route('pemasukan.store')}}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="row">
				<input type="hidden" class="form-control" placeholder="Masukkan no nota" name="order_id" value={{$order_id}}>
				<div class="form-group col-10">
					<label for="exampleInputEmail1">Tanggal Pembayaran</label>
					<input type="date" class="form-control" placeholder="Masukkan tanggal pembayaran" name="tanggal_bayar">
				</div>
				<div class="form-group col-10">
					<label for="exampleInputEmail1">Nominal</label>
					<input type="text" class="form-control" placeholder="Masukkan nominal" name="nominal">
				</div>
				<div class="form-group col-10">
					<label>Metode Transaksi</label>
					<select class="form-control select2bs4" name="metode_transaksi" style="width: 100%;">
						<option value="Transfer">Transfer</option>
						<option value="Cash">Cash</option>
					</select>
				</div>
				<div class="form-group col-10">
					<label for="exampleInputPassword1">Upload Foto Bukti Pembayaran</label>
					<input type="file" class="form-control" id="exampleInputPassword1" placeholder="upload foto bukti" name="foto_bukti">
				</div>
				<div class = "form-group col-10" style="gap:20px">
					<a href="{{ route('order.edit', $order->id) }}" type="button" class="btn mt-3 btn-outline-primary">Kembali</a>
					<button class="btn btn-primary mt-3">Tambah</button>
				</div>
			</div>
		</form>
@endsection