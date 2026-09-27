<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::orderBy('nama_unit', 'asc')->paginate(15);
        return view('units.index', compact('units'));
    }
}