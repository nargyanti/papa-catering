@extends('layouts.template')

@section('title')
<div>
	<h2>Daftar Pembayaran</h2>
</div>
@endsection

@section('content')

{{-- Notification --}}
@include('layouts.messageAlert')

{{-- header --}}
<div class="mt-2 mb-4">
	<h4>Table Pembayaran</h4>
	<div class="col-md-3">
		<a type="button" class="btn btn-primary btn-block" href="{{route('pemasukan.create')}}"><i class="fa fa-plus"></i> Tambah
			Pembayaran</a>
	</div>
	<hr class="hr">
</div>


{{-- Table --}}
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h2 class="card-title">Table Daftar Pembayaran</h2>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>No Nota</th>
							<th>Order Id</th>
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
							<td>{{$pemasukan->order_id}}</td>
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
										<a href = "{{route('previewFoto', $pemasukan->id)}}" class="btn btn-success">Preview</a>
									@endif
								@endif
							</td>
							<td>
								<a type="button" href="{{route('pemasukan.edit', $pemasukan->id)}}" class="btn btn-warning"><i class="fa fa-edit"
										style="color: white"></i></a>
								<button type="button" class="btn btn-danger" data-idpemasukan="{{$pemasukan->id}}" data-toggle="modal"
									data-target="#deletePemasukan"><i class="fa fa-trash"></i></button>
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



{{-- Modal --}}
{{-- Modal Delete --}}
<div class="modal fade" id="deletePemasukan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Hapus Pemasukan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			</div>
			<form action="{{route('pemasukan.destroy', 'test')}}" method="post">
				{{method_field('DELETE')}}
				{{csrf_field()}}
				<div class="modal-body">
					<p class="text-center"><i class="fas fa-exclamation-circle" style="font-size:100px; color: #e86464"></i></p>
					<p class="text-center" style="font-size:20px; color: #e86464">
						Yakin untuk menghapus data ini?
					</p>
					<input type="hidden" name="id_pemasukan" id="idPemasukan" value="">

				</div>
				<div class="modal-footer">
					<a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
					<button type="submit" class="btn btn-primary">Ya, Hapus</button>
				</div>
			</form>
		</div>
	</div>
</div>


@endsection