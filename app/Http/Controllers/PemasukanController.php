<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Order;

class PemasukanController extends Controller
{

    public function index()
    {
        $pemasukan = Pemasukan::get();
        return view('pages.kasir.pemasukan.index', compact('pemasukan'));
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

        $pemasukan->tanggal_bayar = $request->get('tanggal_bayar');
        $pemasukan->nominal = $request->get('nominal');
        $pemasukan->metode_transaksi = $request->get('metode_transaksi');

        $order = new Order;
        $order->id = $request->get('order_id');

        $pemasukan->order()->associate($order);
        $pemasukan->save();

        return redirect()->route('pemasukan.index')
            ->with('success', 'Pemasukan Berhasil Ditambahkan');

    }

 
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
