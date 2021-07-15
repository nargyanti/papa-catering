@extends('layouts.template')

@section('title')
<div>
	<h2>Welcome Developer</h2>
</div>
@endsection

@section('content')
			<form action = "{{route('user.store')}}" method="POST">
				@csrf
					<div class="row">
						<div class="form-group col-12">
							<label for="exampleInputEmail1">Nama</label>
							<input type="text" class="form-control"  placeholder="Masukkan nama" name = "nama_lengkap">
						</div>
						<div class="form-group col-12">
							<label for="exampleInputEmail1">Username</label>
							<input type="text" class="form-control" placeholder="Masukkan usernmae" name="username">
						</div>
						<div class="form-group col-12">
							<label for="exampleInputEmail1">Email address</label>
							<input type="email" class="form-control"  placeholder="Masukkan email" name = "email">
						</div>
						<div class="form-group col-12">
							<label for="exampleInputEmail1">No Telepon</label>
							<input type="text" class="form-control"  placeholder="Masukkan no telepon" name = "no_telepon">
						</div>
						<div class="form-group col-12">
							<label>Level</label>
							<select class="form-control select2bs4 col-12" name = "level" style="width: 100%;">
								<option value="Kasir">Kasir</option>
								<option value="Developer">Developer</option>
								<option value="Admin">Admin</option>
								<option value="Supervisor">Supervisor</option>
							</select>
						</div>
						<div class="form-group col-12">
							<label for="exampleInputPassword1">Password</label>
							<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name = "password">
						</div>
						<div class="form-group col-12">
							<a href="{{route('user.index')}}" type="button" class = "btn mt-3 btn-outline-primary">Kembali</a>
							<button class = "btn btn-primary mt-3">Tambah</button>
						</div>
					</div>
			</form>
@endsection