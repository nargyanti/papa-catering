<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\Pemasukan;
use PDF;
use Auth;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $orders = Order::all();
        return view('pages.kasir.index', ['user' => $user, 'orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.kasir.order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([            
            'tanggal_pesan' => 'required',
            'nama_pemesan' => 'required',
            'telepon' => 'required',
            'tanggal_kirim' => 'required',
            'jam_kirim' => 'required',
            'alamat' => 'required',
        ]);
        
        $order = new Order;
        $order->kasir_id = Auth::user()->id;
        $order->tanggal_pesan = $request->get('tanggal_pesan');
        $order->nama_pemesan = $request->get('nama_pemesan');        
        $order->telepon = $request->get('telepon');
        $order->tanggal_kirim = $request->get('tanggal_kirim');
        $order->jam_kirim = $request->get('jam_kirim');        
        $order->status_pembayaran = 'Belum Lunas';
        $order->status_pengiriman = 'Belum Dikirim';
        $order->status_pemesanan = 'Diproses';
        $order->alamat = $request->get('alamat');
                               
        $user = new User;                
        $user->id = $order->kasir_id;                
        $order->user()->associate($user);        
        $order->save();          
        
        $products = DB::table('products')->orderBy('nama', 'asc')->get();      

        // redirect after add data
        return view('pages.kasir.orderDetail.create', ['order' => $order, 'products' => $products]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $order = Order::find($id);
        $orderDetails = OrderDetail::with('product', 'order')->where('order_id', $id)->get();        
        $pemasukan = Pemasukan::with('order')->where('order_id', $id)->get();
        return view('pages.kasir.order.show', ['user' => $user, 'order' => $order, 'orderDetails' => $orderDetails, 'pemasukan' => $pemasukan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        $orderDetails = OrderDetail::with('product', 'order')->where('order_id', $id)->get();        
        $pemasukan = Pemasukan::with('order')->where('order_id', $id)->get();
        return view('pages.kasir.order.edit', ['order' => $order, 'orderDetails' => $orderDetails, 'pemasukan' => $pemasukan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([                        
            'nama_pemesan' => 'required',
            'telepon' => 'required',
            'tanggal_kirim' => 'required',
            'jam_kirim' => 'required',
            'alamat' => 'required',
        ]);
        
        $order = Order::find($id);                
        $order->nama_pemesan = $request->get('nama_pemesan');        
        $order->telepon = $request->get('telepon');
        $order->tanggal_kirim = $request->get('tanggal_kirim');
        $order->jam_kirim = $request->get('jam_kirim');                
        $order->alamat = $request->get('alamat');
        $order->keterangan = $request->get('keterangan');
        $order->status_pengiriman = $request->get('status_pengiriman');
                               
        $user = new User;                
        $user->id = $order->kasir_id;                
        $order->user()->associate($user);        
        $order->save();             

        // redirect after add data
        return redirect()->route('kasir.index', $order->id)
            ->with('success', 'Pemesanan Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function batal($id) {
        $order = Order::find($id);                
        $order->status_pemesanan = "Dibatalkan";
        $order->save();
        return redirect()->route('kasir.index')
            ->with('success', 'Pemesanan Berhasil Dibatalkan');
    }



    public function cetakNotaPemesanan($id){
        $order = Order::find($id);
        $orderDetails = OrderDetail::with('product', 'order')->where('order_id', $id)->get();  
        $customPaper = array(0,0,400,400);
        $filename = 'orderID' . "-" . $id;

        $nota = PDF::loadview('pages.kasir.order.notaPemesanan', compact('order'))->setPaper($customPaper, 'potrait');
        return $nota->stream($filename);
    }

    public function cetakNotaKeseluruhan($id){

    }

    
    public function selesai($id) {
        $order = Order::find($id);
        if($order->status_pengiriman == "Terkirim" && $order->status_pembayaran == "Lunas") {
            $order->status_pemesanan = "Selesai";
            $order->save();
            return redirect()->route('kasir.index')
                ->with('success', 'Pemesanan Berhasil Ditandai Sebagai Selesai');
        } else {
            if($order->status_pembayaran == "Belum Lunas") {
                return redirect()->route('kasir.index')
                    ->with('fail', 'Pembayaran Pemesanan Belum Lunas');  
            } else if($order->status_pengiriman == "Belum Dikirim") {
                return redirect()->route('kasir.index')
                    ->with('fail', 'Pemesanan Belum Terkirim');             
            }
        }                 
    }
}
