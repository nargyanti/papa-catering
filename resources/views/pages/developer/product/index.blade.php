@extends('layouts.template')

@section('title')
<div>
	<h2>Welcome Developer</h2>
</div>
@endsection

@section('content')
{{-- header --}}
<div class = "mt-2 mb-4">
	<h4>Produk Data</h4>
	<div class="col-md-3">
		<a href="{{ route('product.create') }}"><button type="button" class="btn btn-primary btn-block"><i class="fa fa-plus"></i>Tambah Produk</button></a>
	</div>
	<hr class = "hr">
</div>

{{-- Table --}}
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h2 class="card-title">Tabel Daftar Produk</h2>
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
				<table class="table table-hover" id ="productTable">
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
													<a type="button" class="btn btn-outline-primary" data-dismiss="modal">Batal</a>
													<button type="submit" class="btn btn-primary">Ya, Hapus</button>
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
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
</div>

@endsection