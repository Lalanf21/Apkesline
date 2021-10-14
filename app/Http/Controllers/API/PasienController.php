<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\PasienModel;
use Illuminate\Http\Request;


class PasienController extends Controller
{
    public function getPasien($kode_unik,$no_hp)
    {
        $pasien = PasienModel::with('gender')->where([
            ['kode_unik', $kode_unik],
            ['no_hp', $no_hp],
            ['status_id', 10],
        ])->first();

        if ($pasien) {
            return ResponseFormatter::success($pasien,'Data pasien berhasil di ambil');
        }else{
            return ResponseFormatter::error('','Data pasien tidak di temukan','404');
        }

    }

    public function updateSaldo(Request $request)
    {
        $pasien = PasienModel::where('id', $request->id)->firstOrFail();
        $pasien->saldo -= $request->biaya_charge;
        $pasien->update();
        return ResponseFormatter::success($pasien);
    }
}
