@extends('layouts.template')

@section('title')
<div>
	<h2>Welcome Developer</h2>
</div>
@endsection

@section('content')

{{-- Notification --}}
<div>
	@if ($message = Session::get('fail'))
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Failed!!</strong><span> {{ $message }}</span>
	</div>
	@elseif ($message = Session::get('success'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Success!!</strong><span> {{ $message }}</span>
	</div>
	@endif
</div>

{{-- header --}}
<div class = "mt-2 mb-4">
	<h4>User Data</h4>
	<div class="col-md-3">
		<a type="button" class="btn btn-primary btn-block" href = "{{route('user.create')}}"><i class="fa fa-plus"></i> Tambah Pengguna</a>
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
						@foreach($user as $user)
						<tr>
							<td>{{$no++}}</td>
							<td>{{$user->nama_lengkap}}</td>
							<td>{{$user->username}}</td>
							<td>{{$user->email}}</td>
							<td>{{$user->no_telepon}}</td>
							{{-- <td>{{$dev->password}}</td> --}}
							<td>{{$user->level}}</td>
							<td>
								<a type="button" href = "{{route('user.create')}}"class="btn btn-warning"><i class="fa fa-edit" style="color: white"></i></a>
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