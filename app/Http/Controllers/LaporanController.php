<?php

namespace App\Http\Controllers;

use App\Model\TopupModel;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = TopupModel::with('pasien','users')->get();
        $total = TopupModel::sum('nominal');
        return view('laporan.index', compact('laporan','total'));
    }
}
