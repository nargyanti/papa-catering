<div class="row">
	@foreach($products as $product)
	<div class="col-4">
		<div class="card">
			<div class="card-body text-center">
				<h5><b>{{ $product->nama }} - {{ $product->varian }}</b></h5>
				<h5 class="mt-4">Rp {{ $product->harga_satuan }}</h5><br>
				<button class="btn btn-outline-primary" style="width:80%;border-radius:10px"
					onClick="cart('{{ $product->id }}', '{{ $product->nama }}', '{{ $product->varian }}', '{{ $product->harga_satuan }}' )">Tambah</button>
			</div>
		</div>
	</div>
	@endforeach
</div>