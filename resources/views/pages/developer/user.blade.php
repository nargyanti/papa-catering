@extends('layouts.template')

@section('title')
<div>
	<h2>Welcome Developer</h2>
</div>
@endsection

@section('content')
{{-- header --}}
<div class = "mt-2 mb-4">
	<h4>User Data</h4>
	<div class="col-md-3">
		<button type="button" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Tambah Pengguna</button>
	</div>
	<hr class = "hr">
</div>


{{-- Table --}}
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h2 class="card-title">Table Daftar Pengguna</h2>
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
				<table class="table table-hover" id ="userTable">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Username</th>
							<th>Email</th>
							<th>Telepon</th>
							{{-- <th>Password</th> --}}
							<th>Level</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@php $no = 1 @endphp
						@foreach($developer as $dev)
						<tr>
							<td>{{$no++}}</td>
							<td>{{$dev->nama_lengkap}}</td>
							<td>{{$dev->username}}</td>
							<td>{{$dev->email}}</td>
							<td>{{$dev->no_telepon}}</td>
							{{-- <td>{{$dev->password}}</td> --}}
							<td>{{$dev->level}}</td>
							<td>
								<a type="button" class="btn btn-warning"><i class="fa fa-edit" style="color: white"></i></a>
								<a type="button" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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