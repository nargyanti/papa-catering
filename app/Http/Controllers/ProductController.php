<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();        
        return view('pages.developer.product.index', ['products' => $products]);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.developer.product.create');
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
            'nama' => 'required',
            'kategori' => 'required',
            'varian' => 'required',
            'harga_satuan' => 'required',            
        ]);

        $product = New Product;
        $product->nama = $request->get('nama');
        $product->kategori = $request->get('kategori');            
        $product->varian = $request->get('varian');
        $product->harga_satuan = $request->get('harga_satuan');            

        $product->save();

        return redirect()->route('product.index')
            ->with('success', 'Produk Berhasil Ditambahkan');
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
        $product = Product::find($id);        
        return view('pages.developer.product.edit', ['product' => $product]);
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
            'nama' => 'required',
            'kategori' => 'required',
            'varian' => 'required',
            'harga_satuan' => 'required',            
        ]);

        $product = Product::find($id);
        $product->nama = $request->get('nama');
        $product->kategori = $request->get('kategori');
        $product->varian = $request->get('varian');
        $product->harga_satuan = $request->get('harga_satuan');            
            
        $product->save();                

        return redirect()->route('product.index')
            ->with('success', 'Produk Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->route('product.index')
            ->with('success', 'Produk Berhasil Dihapus');
    }
}
