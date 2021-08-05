@extends('layouts.template')

@section('title')
<div>
	<h2>Detail Pemesanan</h2>
</div>
@endsection

@section('content')
@include('layouts.errorAlert')
<div class="row">
    <div class="col-8">
        {{-- Search --}}
        <div class="row my-3">
            <form class="d-flex col-12">
                <input class="form-control mr-2" type="search" placeholder="Cari Produk" aria-label="Search">
                <!-- <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button> -->
                <button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
            </form>            
        </div>        
        
        {{-- Navigasi --}}
        <ul class="nav nav-pills my-3 text-center" id="pills-tab" role="tablist">
            <li class="nav-item col-4">
                <a class="nav-link active" id="pills-kue-asin-tab" data-toggle="pill" href="#pills-kue-asin" role="tab" aria-controls="pills-kue-asin" aria-selected="true" style="border:1px solid #007BFF;border-radius:30px">Kue Asin</a>
            </li>
            <li class="nav-item col-4">
                <a class="nav-link" id="pills-kue-manis-tab" data-toggle="pill" href="#pills-kue-manis" role="tab" aria-controls="pills-kue-manis" aria-selected="false" style="border:1px solid #007BFF;border-radius:30px">Kue Manis</a>
            </li>
            <li class="nav-item col-4">
                <a class="nav-link" id="pills-kotak-tab" data-toggle="pill" href="#pills-kotak" role="tab" aria-controls="pills-kotak" aria-selected="false" style="border:1px solid #007BFF;border-radius:30px">Kotak</a>
            </li>
        </ul>
        
        {{-- Content --}}
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-kue-asin" role="tabpanel" aria-labelledby="pills-kue-asin-tab">
                @include('layouts.productList', ['kategori' => 'Kue Asin'])
            </div>
            <div class="tab-pane fade" id="pills-kue-manis" role="tabpanel" aria-labelledby="pills-kue-manis-tab">
                @include('layouts.productList', ['kategori' => 'Kue Manis'])
            </div>
            <div class="tab-pane fade" id="pills-kotak" role="tabpanel" aria-labelledby="pills-kotak-tab">    
                @include('layouts.productList', ['kategori' => 'Kotak'])
            </div>
        </div>        
    </div>

    {{-- Keranjang --}}
    <div class="col-4">
        <div class="card my-3">
            <div class="card-header text-center" style="background-color:#0B4075;color:white">
                <h4>Keranjang Belanja</h4>
            </div>
            <div class="card-body">
                <div>
                    <h5 class="font-weight-bold">Pesanan</h5>
                    <table class="my-3" id= "tabel_cart">							
						@foreach($orderDetails as $item)
						<tr id="item{{$item->product_id}}">
							<td class="pr-2">{{$item->product->nama}} {{$item->product->varian}}</td>
							<td class="px-2"><input type="number" oninput='updateQty({{$item->product_id}})' id="kuantitas{{$item->product->id}}" name="kuantitas" min=1 value={{$item->kuantitas}} style="width:60px"
									class="form-control text-center"></td>
							<td class="px-2">Rp. {{$item->product->harga_satuan}}</td>
							<td class="pl-2"><a class="btn btn-danger" onclick='deleteFromCart({{$item->product_id}})'><i class="fa fa-trash"></i></a></td>
						</tr> 					
						@endforeach
                    </table>
                </div>
            </div>
        </div>
        <form action="{{route('orderDetail.update', $order->id)}}" method="POST">
        @csrf
				@method('PUT')
        <div class="card">
            <div class="card-body">
                <h5 class="font-weight-bold">Metode Pengiriman</h5>
                <select name="metode_pengiriman" class="form-control">            
                    <option value="Diantar" selected>Diantar</option>
                    <option value="Diambil">Diambil</option>            
                </select> 
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="font-weight-bold">Pesan dari Customer</h5>
                <textarea name="keterangan" placeholder="Masukkan pesan di sini" style="width:100%;height:100px" class="form-control">{{$order->keterangan}}</textarea>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="font-weight-bold">Total Harga Pesanan:</h5>
                <p style="font-size:50px" class="text-center" id="harga_total_pesanan">
					{{$order->harga_total}}
                </p>
            </div>
        </div>

        <div class="text-center">           
                @csrf
				@method('PUT')
                <input type="hidden" class="items" id="items" name="cart">
                <button class="btn btn-primary mb-3" style="width:45%" onclick=convertItemsToJson()>Simpan</button>
            </form>
            {{-- <button class="btn btn-outline-primary mr-3" style="width:45%">Batalkan</button>
            <button class="btn btn-primary" style="width:45%">Simpan</button> --}}
        </div>
    </div>
</div>


<script>
	let items = []    	
	@foreach ($orderDetails as $item)
		addItemToCart('{{ $item->product_id }}', '{{ $item->kuantitas }}', '{{ $item->product->harga_satuan }}')
	@endforeach	
    function cart(id, nama, varian, harga_satuan){                
        const found = isItemExist(id)               
        if (found) {
            alert('Anda sudah menambahkan produk tersebut ke keranjang belanja');            
        } else {            
            let kuantitas = showItemToCart(id, nama, varian, harga_satuan)
            addItemToCart(id, kuantitas, harga_satuan)                       
        }        
    }

    function isItemExist(id) {
        return items.some(item => item.id === id);
    }

    function addItemToCart(id, kuantitas, harga_satuan) {		
        let inputQty = document.querySelector(`#kuantitas${id}`)        
        let newData = {};        
        newData.id = id;
        newData.kuantitas = kuantitas;
        newData.harga_satuan = harga_satuan;
        items.push(newData)     		
        showTotalPrice()           
    }

    function showItemToCart(id, nama, varian, harga_satuan) {
        let parent = document.querySelector('#tabel_cart');
        let cartRow = `
            <tr id="item${id}">
                <td class="pr-2">${nama} ${varian}</td>
                <td class="px-2"><input type="number" oninput='updateQty(${id})' id="kuantitas${id}" name="kuantitas" min=1 value=1 style="width:60px"
                        class="form-control text-center"></td>
                <td class="px-2">Rp. ${harga_satuan}</td>
                <td class="pl-2"><a class="btn btn-danger" onclick='deleteFromCart(${id})'><i class="fa fa-trash"></i></a></td>
            </tr>        
        `        
        parent.insertAdjacentHTML('beforeend', cartRow);
        let inputQty = document.querySelector(`#kuantitas${id}`);        
        return inputQty.value;
    }

    function convertItemsToJson() {        
        let cart = document.querySelector('#items')                
        cart.value = JSON.stringify(items)
        console.log(cart)
    }

    function deleteFromCart(id){    
        let cartRow = document.querySelector(`#item${id}`);   		        
		cartRow.remove();    		   		
        items = items.filter(function(item) {             
			return item.id != id; 
        });        
        console.log(items)
        showTotalPrice()
    }

    function updateQty(id){
        let inputQty = document.querySelector(`#kuantitas${id}`)        
        console.log(inputQty.value)
        items.forEach(function (item) {
            if(item.id == id) {                
                item.kuantitas = inputQty.value                                                                                
            }
        });  
        showTotalPrice()                      
    }

    function showTotalPrice() {
        let totalPrice = sumTotalPrice()
        let hargaTotalElement = document.querySelector('#harga_total_pesanan')
        hargaTotalElement.innerHTML = totalPrice        
    }

    function sumTotalPrice() {        
        let totalPrice = 0
        items.forEach(function (item) {            
            totalPrice = totalPrice + (item.kuantitas * item.harga_satuan)            
        });         
        return totalPrice
    }

</script>
@endsection