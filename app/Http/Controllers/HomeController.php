<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $level = Auth::user()->level;
        if ($level == "Admin") {
            return redirect()->to('admin');
        } else if ($level == "Kasir") {
            return redirect()->to('kasir');
        } else if ($level == "Supervisor") {
            return redirect()->to("supervisor");
        } else if ($level == "Developer") {
            return redirect()->to("developer");
        } else {
            return redirect()->to('logout');
        }
    }
}
