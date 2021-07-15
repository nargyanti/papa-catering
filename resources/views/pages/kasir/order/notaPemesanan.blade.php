<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
		integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<style>
		html {
			margin: 0;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			font-size: 12px;

		}
	</style>
</head>
<html>
<div style="margin-top:20px;">
	<center>
		<h4 style="margin-top:10px;"><b>Pap's Catering</b></h4>
		<p>Jl. Majangstories RT 05 / RW 01, Kemanggisan, Kota Malang, Jawa Timur 11323</p>
	</center>
</div>
<hr style="color: rgb(172, 172, 172) !important">
<div class="">
	<center>
		<p style="margin-top: -5px"><b>No Order: {{$order->id}}</b></p>
		<p style="margin-top: -10px">{{$order->nama_pemesan}}, {{$order->telepon}}</p>
		<p style="margin-top: -10px">{{$order->alamat}}</p>
	</center>
</div>

{{-- Customer Bio --}}
<div style="height: 200px mt-2">
	<table class="table table-stripped">
		<thead style="background: rgb(244, 244, 255)">
			<tr>
				<th>No</th>
				<th>Jenis Pesanan</th>
				<th>Jumlah</th>
				<th>Harga Satuan</th>
				<th>Harga Total</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>test</td>
				<td>test</td>
				<td>test</td>
				<td>test</td>
				<td>test</td>
			</tr>
		</tbody>
	</table>
</div>

<div
		style="padding: 10px;">
		<div>
			<p style="text-align: right"><b>Grand Total</b> Rp. 30.000</p>
		</div>
</div>



<div class="mt-2 ">
		<div  class = "col-2 mx-3" style="">
			<p>Tanda Terima,</p>
			<br>
			<hr>
		</div>
</div>


</html>