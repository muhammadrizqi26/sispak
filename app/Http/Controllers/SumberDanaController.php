<?php

namespace App\Http\Controllers;

use App\Models\SumberDana;
use Illuminate\Http\Request;

class SumberDanaController extends Controller
{
    public function index()
    {
        $sumberDanas = SumberDana::orderBy('nama_sumber_dana', 'asc')->paginate(15);
        return view('sumber_danas.index', compact('sumberDanas'));
    }
}