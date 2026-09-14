<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerusahaanController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('perusahaan.index', compact('user'));
    }
}
