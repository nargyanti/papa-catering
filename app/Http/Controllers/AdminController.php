<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pengeluaran;
use App\Models\Pemasukan;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $pemasukan = Pemasukan::get();
        $pengeluaran = Pengeluaran::get();
        $result = Pemasukan::selectRaw('year(tanggal_bayar) year, count(nominal) data')
                ->groupBy('year')
                ->orderBy('year', 'asc')
                ->get();
        return view('pages.admin.bukuKas.index', ['user' => $user, 'pengeluaran'=>$pengeluaran, 'pemasukan'=>$pemasukan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function bukuKasRekap()
    {
        $tahun_awal = DB::table('pemasukan')
        ->selectRaw('YEAR(tanggal_bayar)')
        ->orderBy('tanggal_bayar', 'asc')
        ->get();

        $minprice = DB::table('products')->select('*')->where('category_id','=',$id)->min('price');
        return view('pages.admin.bukuKas.index');   
    }
    public function bukuKasRekapHarian($tahun, $bulan, $hari) 
    {
        $user = Auth::user();
        $tanggal = $tahun."-".$bulan."-".$hari; 
        $pemasukan = DB::table('pemasukan')
                        ->whereDate('tanggal_bayar', $tanggal)
                        ->get();
        $pengeluaran = DB::table('pengeluaran')
                        ->whereDate('tanggal_pengeluaran', $tanggal)
                        ->get();
        return view('pages.admin.bukuKas.rekapHarian', ['user' => $user, 'pengeluaran'=>$pengeluaran, 'pemasukan'=>$pemasukan]); 
    }
    public function bukuKasRekapBulanan($tahun, $bulan)
    {
        return view('pages.admin.bukuKas.rekapBulanan');   
    }
    public function bukuKasRekapTahunan()
    {
        return view('pages.admin.bukuKas.rekapTahunan');   
    }
}
