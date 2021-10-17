<?php

namespace App\Http\Controllers;

use App\Model\TopupModel;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = TopupModel::with('pasien','users')->paginate(2);
        $total = TopupModel::sum('nominal');
        $tahun_awal = date('Y')-10;
        $tahun_akhir = date('Y')+2;
        return view('laporan.index', compact('laporan','total', 'tahun_awal','tahun_akhir'));
    }

    public function filter(Request $request)
    {
        $tahun_awal = date('Y')-10;
        $tahun_akhir = date('Y')+2;

        if($request->filled('bulan')){
            $laporan = TopupModel::whereMonth('created_at',$request->bulan)->paginate(2)->appends(['bulan' => $request->bulan]);
            $total = TopupModel::whereMonth('created_at',$request->bulan)->sum('nominal');
        }
        elseif($request->filled('tahun'))
        {
            $laporan = TopupModel::whereYear('created_at',$request->tahun)->paginate(2)->appends(['tahun' => $request->tahun]);
            $total = TopupModel::whereYear('created_at',$request->tahun)->sum('nominal');
        }
            $laporan = TopupModel::whereYear('created_at', $request->tahun)
                        ->whereMonth('created_at',$request->bulan)
                        ->paginate(2)
                        ->appends([
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                        ]);
            $total = TopupModel::whereYear('created_at', $request->tahun)
                        ->whereMonth('created_at',$request->bulan)
                        ->sum('nominal');

        return view('laporan.index', compact('laporan','total', 'tahun_awal','tahun_akhir'));

    }
}
