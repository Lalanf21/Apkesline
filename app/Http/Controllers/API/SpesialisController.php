<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\SpesialisModel;

class SpesialisController extends Controller
{
    public function getSpesialis()
    {
        $spesialis = SpesialisModel::get();

        if ($spesialis) {
            return ResponseFormatter::success($spesialis,'Data spesialis berhasil di ambil');
        }else{
            return ResponseFormatter::error('','Data spesialis tidak di temukan','404');
        }
    }
}
