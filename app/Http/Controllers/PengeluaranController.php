<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengeluaran = Pengeluaran::join('users', 'pengeluaran.admin_id', 'users.id')
            ->get(['pengeluaran.*', 'users.nama_lengkap']);
        return view('pages.admin.pengeluaran.index', compact('pengeluaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.pengeluaran.pengeluaranAdd');
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
            'jenis_beban' => 'required',
            'tanggal_pengeluaran' => 'required',
            'jenis_pengeluaran' => 'required',
            'metode_transaksi' => 'required',
            'foto_bukti' => 'nullable',
            'nominal' => 'required',
            'keterangan' => 'required',
        ]);

        $pengeluaran = new Pengeluaran;
        if ($request->file('foto_bukti')) {
            $image_name = $request->file('foto_bukti')->store('pengeluaran', 'public');
            $pengeluaran->foto_bukti = $image_name;
        }

        $pengeluaran->admin_id = Auth::user()->id;
        $pengeluaran->tanggal_pengeluaran = $request->get('tanggal_pengeluaran');
        $pengeluaran->jenis_beban = $request->get('jenis_beban');
        $pengeluaran->jenis_pengeluaran = $request->get('jenis_pengeluaran');
        $pengeluaran->nominal = $request->get('nominal');
        $pengeluaran->metode_transaksi = $request->get('metode_transaksi');
        $pengeluaran->keterangan = $request->get('keterangan');

        // $user = new User;
        // $user->id = $pengeluaran->admin_id;
        // $pengeluaran->user()->associate($user);
        $pengeluaran->save();

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Pengeluaran Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengeluaran = Pengeluaran::where('id', $id)->first();
        return view('pages.admin.pengeluaran.pengeluaranEdit', compact('pengeluaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_beban' => 'required',
            'tanggal_pengeluaran' => 'required',
            'jenis_pengeluaran' => 'required',
            'metode_transaksi' => 'required',
            'foto_bukti' => 'nullable',
            'nominal' => 'required',
            'keterangan' => 'required',
        ]);

        $pengeluaran = Pengeluaran::where('id', $id)->first();
        if ($request->file('foto_bukti')) {
            if ($pengeluaran->foto_bukti && file_exists(storage_path('app/public/' . $pengeluaran->foto_bukti))) {
                Storage::delete('public/' . $pengeluaran->foto_bukti);
                $image_name = $request->file('foto_bukti')->store('pengeluaran', 'public');
                $pengeluaran->foto_bukti = $image_name;
            }
        }

        $pengeluaran->admin_id = Auth::user()->id;
        $pengeluaran->tanggal_pengeluaran = $request->get('tanggal_pengeluaran');
        $pengeluaran->jenis_beban = $request->get('jenis_beban');
        $pengeluaran->jenis_pengeluaran = $request->get('jenis_pengeluaran');
        $pengeluaran->nominal = $request->get('nominal');
        $pengeluaran->metode_transaksi = $request->get('metode_transaksi');
        $pengeluaran->keterangan = $request->get('keterangan');

        // $user = new User;
        // $user->id = $pengeluaran->admin_id;
        // $pengeluaran->user()->associate($user);
        $pengeluaran->save();

        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);

        if ($pengeluaran->foto_bukti && file_exists(storage_path('app/public/' . $pengeluaran->foto_bukti))) {
            Storage::delete('public/' . $pengeluaran->foto_bukti);
        }

        $pengeluaran->delete();

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Data Pengeluaran berhasil di hapus');
    }

    public function previewPengeluaran($id)
    {
        $pengeluaran = Pengeluaran::where('id', $id)->first();
        $url = storage_path('app/public/' . $pengeluaran->foto_bukti);
        return response()->file($url);
    }
}
