@extends('layouts.template')

@section('title')
<div>
	<h2>Edit Pesanan</h2>
</div>
@endsection

@section('content')
<a href="{{ route('kasir.index') }}"><button type="button" class="btn btn-primary my-3" style="width:150px"><i class="fa fa-arrow-left mr-2"></i>
    Kembali</button></a>
<div>
    @include('layouts.errorAlert')
    <form action="{{ route('order.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')    
        <div class="row">   
            <div class="form-group col-3">
                <label>No. Nota Pemesanan</label>
                <input type="text" class="form-control font-weight-bold" placeholder="Masukkan nama pemesan" name="nama_pemesan" value="{{ $order->id }}" disabled>        
            </div> 
            <div class="form-group col-9">
                <label>Nama Pemesan</label>
                <input type="text" class="form-control" placeholder="Masukkan nama pemesan" name="nama_pemesan" value="{{ $order->nama_pemesan }}">        
            </div>
            <div class="form-group col-4">
                <label>No. Telepon</label>
                <input type="text" class="form-control" placeholder="Masukkan nomor telepon" name="telepon" value="{{ $order->telepon }}">        
            </div>
            <div class="form-group col-4">
                <label>Tanggal Kirim</label>
                <input type="date" class="form-control" placeholder="dd/mm/yyyy" name="tanggal_kirim" value="{{ $order->tanggal_kirim }}">        
            </div>
            <div class="form-group col-4">
                <label>Jam Kirim</label>
                <input type="time" class="form-control" name="jam_kirim" value="{{ $order->jam_kirim }}">
            </div>
            <div class="form-group col-6">
                <label>Alamat</label>
                <textarea class="form-control" rows="4" name="alamat" placeholder="Masukkan alamat">{{ $order->alamat }}</textarea>
            </div>
            <div class="form-group col-6">
                <label>Keterangan</label>
                <textarea class="form-control" rows="4" name="keterangan" placeholder="Masukkan keterangan">{{ $order->keterangan }}</textarea>
            </div>
            <div class="form-group col-6">
                <label>Status Pengiriman</label>
                <select class="form-control" name="status_pengiriman" style="width: 100%;">
                    <option value="Belum Dikirim" {{ $order->status_pengiriman == "Belum Terkirim" ? 'selected' : '' }}>Belum Dikirim</option>            
                    <option value="Terkirim" {{ $order->status_pengiriman == "Terkirim" ? 'selected' : '' }}>Terkirim</option>                        
                </select>
            </div>    
        </div>
        <div>
            <button type="button" class="btn btn-danger mr-3" data-toggle="modal" data-target="#batalOrder" style="width:150px">Batalkan Pesanan</button>
            <button type="submit" class="btn btn-primary" style="width:150px">Simpan</button>        
        </div>
    </form>

    {{-- Modal Batal Order--}}
    <div class="modal fade" id="batalOrder" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Batalkan Pemesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>            
                <div class="modal-body">
                    <p class="text-center"><i class="far fa-times-circle" style="font-size:100px; color: #e86464"></i></p>
                    <p class="text-center" style="font-size:20px; color: #e86464">
                        Yakin untuk membatalkan pemesanan ini?
                    </p>													                             
                </div>
                <div class="modal-footer">                
                    <a type="button" class="btn btn-outline-primary" data-dismiss="modal" style="width:110px">Tidak</a>
                    <form action="{{ route('order.batal', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')         
                        <button type="submit" class="btn btn-primary" style="width:110px">Ya, Batalkan</button>
                    </form>                 
                </div>            
            </div>
        </div>
    </div>
</div>

{{--- Tabel Pesanan ---}}
<div class="my-5">
    @include('layouts.messageAlert')
    <h2>Daftar Pesanan</h2>
    <a href="#"><button type="button" class="btn btn-primary mt-2 mb-3" style="width:150px">Edit Pesanan</button></a>
    <table class="table table-bordered text-center" style="background-color:white">
        <thead>
            <tr class="bg-primary">
                <th>No</th>
                <th>Nama Pesanan</th>
                <th>Jumlah</th>
                <th>Keterangan</th>                                        
                <th>Harga Satuan</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1 @endphp            
            @foreach($orderDetails as $orderDetail)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$orderDetail->product->nama . ' ' . $orderDetail->product->varian}}</td>                    
                <td>{{$orderDetail->kuantitas}}</td>
                <td>{{$orderDetail->keterangan}}</td>                                          
                <td>{{$orderDetail->product->harga_satuan}}</td>
            </tr>            
            @endforeach         
            <tr class="font-weight-bold">                
                <td colspan=4>Total</td>
                <td>{{ $order->total_harga_pesanan }}</td>
            </tr>            
        </tbody>
    </table>    
</div>

<div class="pb-5">
    @include('layouts.messageAlert')
    <h2>Data Pembayaran</h2>    
    <a href="{{ route('createWithId', $order->id) }}"><button type="button" class="btn btn-primary mt-2 mb-3"><i class="fa fa-plus mr-2"></i>
    Tambah Pembayaran</button></a>
    <table class="table table-bordered text-center" style="background-color:white">
        <thead>
            <tr class="bg-primary">
                <th>No</th>
                <th>No Nota</th>
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
                            <a href = "{{route('previewFoto', $pemasukan->id)}}" target="_blank"class="btn btn-success">Preview</a>
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


{{-- Modal --}}
{{-- Modal Delete Pembayaran --}}
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
                    <p class="text-center"><i class="fas fa-exclamation-circle"
                            style="font-size:100px; color: #e86464"></i></p>
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