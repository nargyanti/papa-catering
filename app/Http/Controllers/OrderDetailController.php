<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use DB;
use Cart;
use App\Http\Controllers\Session;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')->orderBy('nama', 'asc')->get();         
        return view('pages.kasir.orderDetail.create', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = DB::table('products')->orderBy('nama', 'asc')->get();         
        return view('pages.kasir.orderDetail.create', ['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // public function store($id, $nama, $kategori, $varian, $harga_satuan) 
    // {
    //     Cart::add($id, $nama, $kategori, $varian, $harga_satuan)->associate("Product");

    //     return redirect()->route('kasir.index')
    //         ->with('success', 'Berhasil Menambahkan Pemesanan');
    //         session()->flash('success_message', 'item added in Cart');
    // }

    public function store(Request $request)
    {     
        $request->validate([                                    
            'metode_pengiriman' => 'required',                                    
        ]);
   
        $cart = json_decode($request->get('cart'), true);        
        
        $order = session('order');                
        $order->save();
        
        foreach ($cart as $item) {
            $product = Product::find($item["id"]); // Ini nyari produk yang dibeli
            $orderDetail = new orderDetail;
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $item["id"];                
            $orderDetail->kuantitas = $item["kuantitas"];
            $orderDetail->harga_total =  $product->harga_satuan * $orderDetail->kuantitas;
            $orderDetail->keterangan = "-";
            
            $orderItem = new Order;
            $orderItem->id = $order->id;
            $orderDetail->order()->associate($orderItem);             
            $orderDetail->save();      
        }        

        // Tambahkan ongkir
        if($request->get('metode_pengiriman') == 'Diantar') {
            $product = Product::where('nama', 'Ongkos Kirim')->first(); // Ini nyari ongkir            
            $orderDetail = new orderDetail;            
            $orderDetail->order_id = $order->id;    
            $orderDetail->product_id = $product->id;                       
            $orderDetail->kuantitas = 1;  
            $orderDetail->keterangan = '-';  
            $orderDetail->harga_total = $product->harga_satuan * $orderDetail->kuantitas;
            
            $orderItem = new Order;
            $orderItem->id = $order->id;
            $orderDetail->order()->associate($orderItem);
            $orderDetail->save();   
        }

        // Menambahkan total harga, metode pengiriman, dan pesan customer        
        $order = Order::find($order->id);
        $order->metode_pengiriman = $request->get('metode_pengiriman');
        $order->keterangan = $request->get('keterangan');                
        $order->total_harga_pesanan = OrderDetail::where('order_id', $order->id)->sum('harga_total');    
        $order->save();    

        // redirect after add data
        return redirect()->route('kasir.index')
            ->with('success', 'Berhasil Menambahkan Pemesanan');
    }

    // public function storeFromCart(Request $request){        
    //     $product = $request->get('cart'); 
    //     $result = json_decode($product, true);

    //     dd($result);
    // }

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

    // public function addToCart($id, $nama, $kategori, $varian, $harga_satuan) 
    // {
    //     Cart::add($id, $nama, $kategori, $varian, $harga_satuan)->associate("Product");

    //     return redirect()->route('orderDetail.index')
    //         ->with('success', 'Berhasil Menambahkan Pemesanan');
    //         session()->flash('success_message', 'item added in Cart');
    // }
}
