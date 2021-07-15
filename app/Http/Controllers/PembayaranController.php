<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Order;

class PembayaranController extends Controller
{
    public function index()
    {
        $pemasukan = Pemasukan::get();
        return view('pages.admin.pemasukan.index', compact('pemasukan'));
    }
}
