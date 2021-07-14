<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();        
        return view('pages.kasir.orderDetail.create', ['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Sementara 1 pesanan
        $request->validate([            
            'nama_pesanan' => 'required',
            'kuantitas' => 'required',            
            'metode_pengiriman' => 'required',                                    
        ]);

        $order = Order::find($request->get('order_id'));
        $orderDetail = new orderDetail;
        $orderDetail->order_id = $request->get('order_id');
        $orderDetail->nama_pesanan = $request->get('nama_pesanan');        
        $orderDetail->harga_satuan = $request->get('harga_satuan');            
        $orderDetail->kuantitas = $request->get('kuantitas');        
        $orderDetail->harga_total = $orderDetail->harga_satuan * $orderDetail->kuantitas;
        $orderDetail->keterangan = $request->get('keterangan');    

        $order = new Order;
        $order->id = $request->get('order_id');
        $orderDetail->order()->associate($order);        
        $orderDetail->save();      
        
        // Tambahkan ongkir
        if($request->get('metode_pengiriman') == 'Diantar') {
            $orderDetail = new orderDetail;
            $orderDetail->nama_pesanan = 'Ongkos Kirim';
            $orderDetail->order_id = $request->get('order_id');     
            $orderDetail->harga_satuan = $request->get('ongkos_kirim');
            $orderDetail->kuantitas = 1;  
            $orderDetail->harga_total = $orderDetail->harga_satuan * $orderDetail->kuantitas;
            
            $order = new Order;
            $order->id = $request->get('order_id');
            $orderDetail->order()->associate($order);
            $orderDetail->save();   
        }

        // Menambahkan total harga, metode pengiriman, dan pesan customer        
        $order = Order::find($request->get('order_id'));
        $order->metode_pengiriman = $request->get('metode_pengiriman');
        if($request->get('pesan_customer')) {
            $order->keterangan = $request->get('pesan_customer');        
        }
        $order->total_pesanan = OrderDetail::where('order_id', $order->id)->get()->sum('total_harga');
        $order->save();    

        // redirect after add data
        return redirect()->route('kasir.index')
            ->with('success', 'Order Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
