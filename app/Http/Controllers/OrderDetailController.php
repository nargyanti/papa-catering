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
            'kuantitas' => 'required',            
            'metode_pengiriman' => 'required',                                    
        ]);

        $product = Product::find($request->get('product_id')); // Ini nyari produk yang dibeli
        $orderDetail = new orderDetail;
        $orderDetail->order_id = $request->get('order_id');
        $orderDetail->product_id = $request->get('product_id');                
        $orderDetail->kuantitas = $request->get('kuantitas');        
        $orderDetail->harga_total =  $product->harga_satuan * $orderDetail->kuantitas;
        $orderDetail->keterangan = $request->get('keterangan');    

        $order = new Order;
        $order->id = $request->get('order_id');
        $orderDetail->order()->associate($order);        
        $orderDetail->save();      
        
        // Tambahkan ongkir
        if($request->get('metode_pengiriman') == 'Diantar') {
            $product = Product::where('nama', 'Ongkos Kirim')->first(); // Ini nyari ongkir            
            $orderDetail = new orderDetail;            
            $orderDetail->order_id = $request->get('order_id');     
            $orderDetail->product_id = $product->id;                       
            $orderDetail->kuantitas = 1;  
            $orderDetail->keterangan = '-';  
            $orderDetail->harga_total = $product->harga_satuan * $orderDetail->kuantitas;
            
            $order = new Order;
            $order->id = $request->get('order_id');
            $orderDetail->order()->associate($order);
            $orderDetail->save();   
        }

        // Menambahkan total harga, metode pengiriman, dan pesan customer        
        $order = Order::find($request->get('order_id'));
        $order->metode_pengiriman = $request->get('metode_pengiriman');
        $order->keterangan = $request->get('pesan_customer');                
        $order->total_harga_pesanan = OrderDetail::where('order_id', $order->id)->sum('harga_total');    
        $order->save();    

        // redirect after add data
        return redirect()->route('kasir.index')
            ->with('success', 'Berhasil Menambahkan Pemesanan');
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
        // Sementara 1 pesanan
        $request->validate([                        
            'kuantitas' => 'required',            
            'metode_pengiriman' => 'required',                                    
        ]);

        $product = Product::find($request->get('product_id')); // Ini nyari produk yang dibeli
        $orderDetail = new orderDetail;
        $orderDetail->order_id = $request->get('order_id');
        $orderDetail->product_id = $request->get('product_id');                
        $orderDetail->kuantitas = $request->get('kuantitas');        
        $orderDetail->harga_total =  $product->harga_satuan * $orderDetail->kuantitas;
        $orderDetail->keterangan = $request->get('keterangan');    

        $order = new Order;
        $order->id = $orderDetail->order_id;
        $orderDetail->order()->associate($order);                
        
        $product = new Product;
        $product->id = $orderDetail->product_id;
        $orderDetail->product()->associate($product);        
        $orderDetail->save(); 
        
        // Tambahkan ongkir
        if($request->get('metode_pengiriman') == 'Diantar') {
            $product = Product::where('nama', 'Ongkos Kirim')->first(); // Ini nyari ongkir            
            $orderDetail = new orderDetail;            
            $orderDetail->order_id = $request->get('order_id');     
            $orderDetail->product_id = $product->id;                       
            $orderDetail->kuantitas = 1;  
            $orderDetail->keterangan = '-';  
            $orderDetail->harga_total = $product->harga_satuan * $orderDetail->kuantitas;
            
            $order = new Order;
            $order->id = $request->get('order_id');
            $orderDetail->order()->associate($order);

            $product = new Product;
            $product->id = $orderDetail->product_id;
            $orderDetail->product()->associate($product);        
            $orderDetail->save();             
        }

        // Menambahkan total harga, metode pengiriman, dan pesan customer        
        $order = Order::find($request->get('order_id'));
        $order->metode_pengiriman = $request->get('metode_pengiriman');
        $order->keterangan = $request->get('pesan_customer');                
        $order->total_harga_pesanan = OrderDetail::where('order_id', $order->id)->sum('harga_total');    
        $order->save();    

        // redirect after add data
        return redirect()->route('kasir.index')
            ->with('success', 'Order Successfully Added');
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
