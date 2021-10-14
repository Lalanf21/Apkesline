<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\DokterModel;
class DokterController extends Controller
{
    public function getDokter($spesialis_id)
    {
        $dokter = DokterModel::with('users')->where('spesialis_id', $spesialis_id)->get();

        if ($dokter->count() > 0) {
            return ResponseFormatter::success($dokter,'Data dokter berhasil di ambil');
        }else{
            return ResponseFormatter::error('','Data dokter tidak di temukan','404');
        }
    }
}
