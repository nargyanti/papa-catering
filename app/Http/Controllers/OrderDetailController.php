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
    public function index(Request $request)
    {

        $search = $request->get('search');
        $idOrder =$request->get('order_id');
        if ($request->get('search')) {
            $products = DB::table('products')
                        ->where('nama','like',"%".$search."%")
                        ->orWhere('varian','like',"%".$search."%")
                        ->orWhere('harga_satuan','like',"%".$search."%")
                        ->orWhere('kategori','like',"%".$search."%")
                        ->orderBy('nama', 'asc')->get();
             
        } else {
            $products = DB::table('products')->orderBy('nama', 'asc')->get();
        }      
        $order = DB::table('orders')->where('id', $idOrder)->first();
        return view('pages.kasir.orderDetail.create', ['order' => $order,'products' => $products]);
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
            $orderDetail = new OrderDetail;
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
            $orderDetail = new OrderDetail;            
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
        $orderDetails = OrderDetail::with('product')->where('order_id', $id)->get();        
        $order = Order::find($id);
        $products = DB::table('products')->orderBy('nama', 'asc')->get();               
        return view('pages.kasir.orderDetail.edit', ['orderDetails' => $orderDetails, 'products' => $products, 'order' => $order]);
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
            'metode_pengiriman' => 'required',                                    
        ]);
   
        $items = json_decode($request->get('cart'), true);  
        $orderDetail = OrderDetail::where('order_id', $id)->get();
        foreach($orderDetail as $od) {
            $od->delete();            
        }
        
        foreach ($items as $item) {
            $product = Product::find($item["id"]); // Ini nyari produk yang dibeli
            $orderDetail = new OrderDetail;
            $orderDetail->order_id = $id;
            $orderDetail->product_id = $item["id"];                
            $orderDetail->kuantitas = $item["kuantitas"];
            $orderDetail->harga_total =  $product->harga_satuan * $orderDetail->kuantitas;
            $orderDetail->keterangan = "-";
            
            $order = new Order;
            $order->id = $id;
            $orderDetail->order()->associate($order);             
            $orderDetail->save();      
        }        

        // Tambahkan ongkir
        if($request->get('metode_pengiriman') == 'Diantar') {
            $product = Product::where('nama', 'Ongkos Kirim')->first(); // Ini nyari ongkir            
            $orderDetail = new OrderDetail;            
            $orderDetail->order_id = $id;    
            $orderDetail->product_id = $product->id;                       
            $orderDetail->kuantitas = 1;  
            $orderDetail->keterangan = '-';  
            $orderDetail->harga_total = $product->harga_satuan * $orderDetail->kuantitas;
            
            $order = new Order;
            $order->id = $id;
            $orderDetail->order()->associate($order);
            $orderDetail->save();   
        }

        // Menambahkan total harga, metode pengiriman, dan pesan customer        
        $order = Order::find($id);
        $order->metode_pengiriman = $request->get('metode_pengiriman');
        $order->keterangan = $request->get('keterangan');                
        $order->total_harga_pesanan = OrderDetail::where('order_id', $order->id)->sum('harga_total');    
        $order->save();    

        // redirect after add data
        return redirect()->route('order.edit', $id)
            ->with('success', 'Berhasil Mengupdate Pemesanan');
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
