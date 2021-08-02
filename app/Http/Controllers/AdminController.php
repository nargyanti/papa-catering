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
        // $pemasukan = Pemasukan::get();
        $pengeluaran =  Pemasukan::selectRaw('year(tanggal_pengeluaran) as tahun_keluar, sum(nominal) as nominal')
        ->groupBy('tahun_keluar')
        ->orderBy('tahun_keluar', 'asc')
        ->get();
        $pemasukan = Pemasukan::selectRaw('year(tanggal_bayar) as tahun_bayar, sum(nominal) as nominal')
                ->groupBy('tahun_bayar')
                ->orderBy('tahun_bayar', 'asc')
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
        $user = Auth::user();
        // $pemasukan = Pemasukan::get();
        $pengeluaran =  Pengeluaran::selectRaw('year(tanggal_pengeluaran) as tahun_keluar, sum(nominal) as nominal')
        ->groupBy('tahun_keluar')
        ->orderBy('tahun_keluar', 'asc')
        ->get();
        $pemasukan = Pemasukan::selectRaw('year(tanggal_bayar) as tahun_bayar, sum(nominal) as nominal')
                ->groupBy('tahun_bayar')
                ->orderBy('tahun_bayar', 'asc')
                ->get();
        return view('pages.admin.bukuKas.index', ['user' => $user, 'pengeluaran'=>$pengeluaran, 'pemasukan'=>$pemasukan]);
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
        return view('pages.admin.bukuKas.rekapHarian', ['user' => $user, 'pengeluaran'=>$pengeluaran, 'pemasukan'=>$pemasukan, 'date'=>$tanggal]); 
    }

    public function bukuKasRekapBulanan($tahun, $bulan)
    {
        $date = $bulan."-".$tahun;
        $user = Auth::user();
        // $dataRekapan = DB::table('pemasukan AS ps')
        //                 ->crossJoin('pengeluaran AS pl')
        //                 ->whereMonth('ps.tanggal_bayar', $bulan)
        //                 ->whereMonth('pl.tanggal_pengeluaran', $bulan)
        //                 ->whereYear('ps.tanggal_bayar', $tahun)
        //                 ->whereYear('pl.tanggal_pengeluaran', $tahun)
        //                 ->get();
        $pengeluaran = DB::table('pengeluaran')
                        ->select('tanggal_pengeluaran', DB::raw('SUM(nominal) as nominal, 
                        DAY(tanggal_pengeluaran) AS hari_keluar, MONTH(tanggal_pengeluaran) AS bulan_keluar, YEAR(tanggal_pengeluaran) as tahun_keluar'))
                        ->whereMonth('tanggal_pengeluaran', $bulan)
                        ->whereYear('tanggal_pengeluaran', $tahun)
                        ->groupBy('tanggal_pengeluaran')
                        ->orderBy('tanggal_pengeluaran', 'asc')
                        ->get();
        $pemasukan = DB::table('pemasukan')
                        ->select('tanggal_bayar', DB::raw('SUM(nominal) as nominal,
                        DAY(tanggal_bayar) AS hari_bayar, MONTH(tanggal_bayar) AS bulan_bayar, YEAR(tanggal_bayar) as tahun_bayar'))
                        ->whereMonth('tanggal_bayar', $bulan)
                        ->whereYear('tanggal_bayar', $tahun)
                        ->groupBy('tanggal_bayar')
                        ->orderBy('tanggal_bayar', 'asc')
                        ->get();
        return view('pages.admin.bukuKas.rekapBulanan', ['user' => $user, 'pengeluaran'=>$pengeluaran, 'pemasukan'=>$pemasukan, 'date'=>$date]);
    }

    public function bukuKasRekapTahunan($tahun)
    {
        $user = Auth::user();
        $pengeluaran = DB::table('pengeluaran')
                        ->select(DB::raw('MONTH(tanggal_pengeluaran) AS bulan_keluar, SUM(nominal) as nominal'))
                        ->whereYear('tanggal_pengeluaran', $tahun)
                        ->groupByRaw('MONTH(tanggal_pengeluaran)')
                        ->orderByRaw('MONTH(tanggal_pengeluaran)', 'asc')
                        ->get();
        $pemasukan = DB::table('pemasukan')
                        ->select(DB::raw('MONTH(tanggal_bayar) AS bulan_bayar, SUM(nominal) as nominal'))
                        ->whereYear('tanggal_bayar', $tahun)
                        ->groupByRaw('MONTH(tanggal_bayar)')
                        ->orderByRaw('MONTH(tanggal_bayar)', 'asc')
                        ->get();
        return view('pages.admin.bukuKas.rekapTahunan', ['user' => $user, 'pengeluaran'=>$pengeluaran, 'pemasukan'=>$pemasukan, 'date'=>$tahun]);   
    }
}
