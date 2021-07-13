<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Auth;

class OrderController extends Controller
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
            'waktu_kirim' => 'required',
            'alamat' => 'required',
        ]);
        
        $order = new Order;
        $order->kasir_id = Auth::user()->id;
        $order->tanggal_pesan = $request->get('tanggal_pesan');
        $order->nama_pemesan = $request->get('nama_pemesan');        
        $order->telepon = $request->get('telepon');
        $order->tanggal_kirim = $request->get('tanggal_kirim');
        $order->jam_kirim = $request->get('waktu_kirim');        
        $order->status_pembayaran = 'Belum Lunas';
        $order->status_pengiriman = 'Belum Dikirim';
        $order->alamat = $request->get('alamat');
                               
        $user = new User;                
        $user->id = $order->kasir_id;                
        $order->user()->associate($user);        
        $order->save();          
        
        $products = Product::all();        

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
