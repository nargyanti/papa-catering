@extends('layouts.template')

@section('title')
<div class="row justify-content-between">
	<div class="col mt-2">
		<h2>Produk Data</h2>
	</div>
	<div class="col-2 mr-3">
		<a href="{{ route('product.create') }}"><button type="button" class="btn btn-primary mt-2 mb-3" style="width:200px"><i class="fa fa-plus mr-2"></i>
		Tambah Produk</button></a>	
	</div>
</div>
@endsection

@section('content')
@include('layouts.messageAlert')
{{-- header --}}

{{-- Table --}}
<div class="card">
	<div class="card-header">
		<h2 class="card-title">Tabel Daftar Produk</h2>		
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<table class="table table-hover table-bordered table-striped text-center" id ="example1">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Kategori</th>
					<th>Varian</th>
					<th>Harga</th>														
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@php $no = 1 @endphp
				@foreach($products as $product)
				<tr>
					<td>{{$no++}}</td>
					<td>{{$product->nama}}</td>
					<td>{{$product->kategori}}</td>
					<td>{{$product->varian}}</td>
					<td>{{$product->harga_satuan}}</td>														
					<td>
						<a type="button" href="{{ route('product.edit', $product->id) }}" class="btn btn-warning"><i class="fa fa-edit" style="color: white"></i></a>
						<a type="button" data-toggle="modal" data-target="#deleteProduct" class="btn btn-danger"><i class="fa fa-trash"></i></a>

						{{-- Modal Delete --}}
						<div class="modal fade" id="deleteProduct" tabindex="-1" role="dialog">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Hapus Produk</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
												aria-hidden="true">&times;</span></button>
									</div>
									<form action="{{route('product.destroy', $product->id)}}" method="post">
										@csrf
										@method('DELETE')  
										<div class="modal-body">
											<p class="text-center"><i class="far fa-times-circle" style="font-size:100px; color: #e86464"></i></p>
											<p class="text-center" style="font-size:20px; color: #e86464">
												Yakin untuk menghapus data ini?
											</p>													
										</div>
										<div class="modal-footer">
											<a type="button" class="btn btn-outline-primary" data-dismiss="modal" style="width:100px">Batal</a>
											<button type="submit" class="btn btn-primary" style="width:100px">Ya, Hapus</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</td>
				</tr>						
				@endforeach
			</tbody>
		</table>
	</div>			
</div>		

@endsection