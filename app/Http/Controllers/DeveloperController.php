<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DeveloperController extends Controller
{
    public function index()
    {
        $user = User::get();
        return view('pages.developer.user.index', compact('user'));
    }

}
