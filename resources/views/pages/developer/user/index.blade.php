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
			</div>
			<!-- /.card-header -->
		<div class="card-body">
			<table id="example1" class="table table-bordered table-striped">
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
								<a type="button" href = "{{route('user.edit', $user->id)}}"class="btn btn-warning"><i class="fa fa-edit" style="color: white"></i></a>
								<button type="button" class="btn btn-danger" data-iduser="{{$user->id}}" data-toggle="modal" data-target="#deleteUser"><i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Hapus User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			</div>
			<form action="{{route('user.destroy', 'test')}}" method="post">
				{{method_field('DELETE')}}
				{{csrf_field()}}
				<div class="modal-body">
					<p class="text-center"><i class="fas fa-exclamation-circle" style="font-size:100px; color: #e86464"></i></p>
					<p class="text-center" style="font-size:20px; color: #e86464">
						Yakin untuk menghapus data ini?
					</p>
					<input type="hidden" name="id_user" id="idUser" value="">

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