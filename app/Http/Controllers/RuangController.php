<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use App\Models\Unit;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    public function index()
    {
        $ruangs = Ruang::with('unit')->orderBy('nama_ruang', 'asc')->paginate(15);
        return view('ruangs.index', compact('ruangs'));
    }
}