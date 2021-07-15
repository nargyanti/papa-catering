<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Order;
use App\Models\OrderDetail;
use Storage;

class PemasukanController extends Controller
{

    public function index()
    {
        $pemasukan = Pemasukan::get();
        return view('pages.kasir.pemasukan.index', compact('pemasukan'));
    }

    public function backToEditOrder($id){
        $order = Order::find($id);
        $orderDetails = OrderDetail::with('product', 'order')->where('order_id', $id)->get();        
        $pemasukan = Pemasukan::with('order')->where('order_id', $id)->get();
        return view('pages.kasir.order.edit', ['order' => $order, 'orderDetails' => $orderDetails, 'pemasukan' => $pemasukan]);
    }

    public function previewFoto($id)
    {
        $pemasukan = Pemasukan::where('id', $id)->first();
        $url = storage_path('app/public/'.$pemasukan->foto_bukti);
        return response()->file($url);
    }

    public function create()
    {
        return view('pages.kasir.pemasukan.pemasukanAdd');
    }


    public function createWithId($id){
        $order = Order::where('id', $id)->first();
        $order_id = $id;
         return view('pages.kasir.pemasukan.pemasukanAdd', compact('order_id', 'order'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'tanggal_bayar' => 'required',
            'nominal' => 'required',
            'metode_transaksi' => 'required',
            'foto_bukti' => 'nullable',
        ]);

        $pemasukan = New Pemasukan;
        if ($request->file('foto_bukti')) {
                $image_name = $request->file('foto_bukti')->store('images', 'public');
                $pemasukan->foto_bukti = $image_name;
        }

        $pemasukan->no_nota = $this->checkIfAva();
        $pemasukan->tanggal_bayar = $request->get('tanggal_bayar');
        $pemasukan->nominal = $request->get('nominal');
        $pemasukan->metode_transaksi = $request->get('metode_transaksi');

        $order = new Order;
        $order->id = $request->get('order_id');

        $pemasukan->order()->associate($order);
        $pemasukan->save();

        $order = Order::find($pemasukan->order_id);
        $nominal = Pemasukan::where('order_id', $order->id)->sum('nominal');                
        if($order->total_harga_pesanan - $nominal <= 0) {
            $order->status_pembayaran = 'Lunas';       
            $order->save();
        }
        
        return redirect()->route('backToEditOrder',$request->get('order_id') )
            ->with('success', 'Pembayaran Berhasil Ditambahkan');

    }

 
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $pemasukan = Pemasukan::where('id', $id)->first();
        return view('pages.kasir.pemasukan.pemasukanEdit', compact('pemasukan'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'order_id' => 'required',
            'tanggal_bayar' => 'required',
            'nominal' => 'required',
            'metode_transaksi' => 'required',
            'foto_bukti' => 'nullable',
        ]);

        $pemasukan = Pemasukan::where('id', $id)->first();
        if ($request->file('foto_bukti')) {
            if($pemasukan->foto_bukti && file_exists(storage_path('app/public/' . $pemasukan->foto_bukti))) {
                Storage::delete('public/' . $pemasukan->foto_bukti);
                $image_name = $request->file('foto_bukti')->store('images', 'public');
                $pemasukan->foto_bukti = $image_name;
            }
        }

        $pemasukan->no_nota = $request->get('no_nota');
        $pemasukan->tanggal_bayar = $request->get('tanggal_bayar');
        $pemasukan->nominal = $request->get('nominal');
        $pemasukan->metode_transaksi = $request->get('metode_transaksi');

        $order = new Order;
        $order->id = $request->get('order_id');

        $pemasukan->order()->associate($order);        
        $pemasukan->save();

        $order = Order::find($pemasukan->order_id);
        $nominal = Pemasukan::where('order_id', $order->id)->sum('nominal');                
        if($order->total_harga_pesanan - $nominal <= 0) {
            $order->status_pembayaran = 'Lunas';       
            $order->save();
        }

        return redirect()->route('backToEditOrder', $request->get('order_id'))
            ->with('success', 'Pembayaran Berhasil Diubah');

    }

    public function checkIfAva()
    {
        $pemasukan = Pemasukan::all();
        $no_nota = "PapC" . "-" . $this->random_strings(3);
        $isAva = True;
        for ($i = 0; $i < count($pemasukan); $i++) {
            if ($pemasukan[$i]->no_nota === $no_nota) {
                $isAva = False;
            } else {
                $isAva = True;
            }
        }
        if ($isAva) {
            return $no_nota;
        } else {
            $this->checkIfAva();
        }
        return $no_nota;
    }

    public function random_strings($length_of_string)
    {
        $str_result = '0123456789';
        return substr(
            str_shuffle($str_result),
            0,
            $length_of_string
        );
    }

    public function destroy(Request $request)
    {
        $pemasukan = Pemasukan::findOrFail($request->id_pemasukan);
        $order_id = $pemasukan->order_id;
        if($pemasukan->foto_bukti && file_exists(storage_path('app/public/' . $pemasukan->foto_bukti))) {
                Storage::delete('public/' . $pemasukan->foto_bukti);
        }        
        $pemasukan->delete();
        
        $order = Order::find($pemasukan->order_id);
        $nominal = Pemasukan::where('order_id', $order->id)->sum('nominal');                
        if($order->total_harga_pesanan - $nominal > 0) {
            $order->status_pembayaran = 'Belum Lunas';       
            $order->save();
        }

        return redirect()->route('backToEditOrder', $order_id)
            ->with('success', 'Data Pembayaran berhasil di hapus');
    }
}
