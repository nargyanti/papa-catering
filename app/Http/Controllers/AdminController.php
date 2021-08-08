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
        $rekapData = DB::table('rekap_data')
                ->select(DB::raw('SUM(nominal_pengeluaran) as nominal_keluar, SUM(nominal_pemasukan) as nominal_masuk,
                YEAR(tanggal_pemasukan) AS tahun_masuk, YEAR(tanggal_pengeluaran) AS tahun_keluar'))
                ->groupBy('tahun_masuk')
                ->groupBy('tahun_keluar')
                ->orderBy('tahun_masuk', 'asc')
                ->orderBy('tahun_keluar', 'asc')
                ->get();

        return view('pages.admin.bukuKas.index', ['user' => $user, 'rekapData'=>$rekapData]);
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
        $rekapData = DB::table('rekap_data')
                ->select(DB::raw('SUM(nominal_pengeluaran) as nominal_keluar, SUM(nominal_pemasukan) as nominal_masuk,
                YEAR(tanggal_pemasukan) AS tahun_masuk, YEAR(tanggal_pengeluaran) AS tahun_keluar'))
                ->groupBy('tahun_masuk')
                ->groupBy('tahun_keluar')
                ->orderBy('tahun_masuk', 'asc')
                ->orderBy('tahun_keluar', 'asc')
                ->get();

        return view('pages.admin.bukuKas.index', ['user' => $user, 'rekapData'=>$rekapData]);
        
    }

    public function bukuKasRekapHarian($tahun, $bulan, $hari) 
    {
        $user = Auth::user();
        $tanggal = $tahun."-".$bulan."-".$hari; 

        $rekapData = DB::table('rekap_data')
                        ->whereDate('tanggal_pengeluaran', $tanggal)
                        ->orWhereDate('tanggal_pemasukan', $tanggal)
                        ->get();
        return view('pages.admin.bukuKas.rekapHarian', ['user' => $user, 'rekapData'=>$rekapData, 'date'=>$tanggal]); 
    }

    public function bukuKasRekapBulanan($tahun, $bulan)
    {
        $date = $bulan."-".$tahun;
        $user = Auth::user();
        $rekapData = DB::table('rekap_data')
                        ->select('tanggal_pemasukan', 'tanggal_pengeluaran', DB::raw('SUM(nominal_pengeluaran) as nominal_keluar, SUM(nominal_pemasukan) as nominal_masuk,
                        DAY(tanggal_pemasukan) AS hari_masuk, MONTH(tanggal_pemasukan) AS bulan_masuk, YEAR(tanggal_pemasukan) as tahun_masuk,
                        DAY(tanggal_pengeluaran) AS hari_keluar, MONTH(tanggal_pengeluaran) AS bulan_keluar, YEAR(tanggal_pengeluaran) as tahun_keluar'))
                        ->where(function ($query1) use($bulan, $tahun){
                            $query1->whereMonth('tanggal_pengeluaran', $bulan)
                                ->whereYear('tanggal_pengeluaran', $tahun);
                        })
                        ->orWhere(function ($query2) use($bulan, $tahun){
                            $query2->whereMonth('tanggal_pemasukan', $bulan)
                                ->whereYear('tanggal_pemasukan', $tahun);
                        })
                        ->groupBy('tanggal_pengeluaran')
                        ->groupBy('tanggal_pemasukan')
                        ->orderByRaw('DAY(tanggal_pemasukan)', 'asc')
                        ->orderByRaw('DAY(tanggal_pengeluaran)', 'asc')
                        ->get();
        return view('pages.admin.bukuKas.rekapBulanan', ['user' => $user, 'rekapData'=>$rekapData, 'date'=>$date]);
    }

    public function bukuKasRekapTahunan($tahun)
    {
        $user = Auth::user();

        $rekapData = DB::table('rekap_data')
                        ->select(DB::raw('SUM(nominal_pengeluaran) as nominal_keluar, SUM(nominal_pemasukan) as nominal_masuk,
                        MONTH(tanggal_pemasukan) AS bulan_masuk, MONTH(tanggal_pengeluaran) AS bulan_keluar'))
                        ->whereYear('tanggal_pengeluaran', $tahun)
                        ->orWhereYear('tanggal_pemasukan', $tahun)
                        ->groupByRaw('MONTH(tanggal_pengeluaran)')
                        ->groupByRaw('MONTH(tanggal_pemasukan)')
                        ->orderByRaw('MONTH(tanggal_pemasukan)', 'asc')
                        ->orderByRaw('MONTH(tanggal_pengeluaran)', 'asc')
                        ->get();
        return view('pages.admin.bukuKas.rekapTahunan', ['user' => $user, 'rekapData'=>$rekapData, 'date'=>$tahun]);   
    }
}
