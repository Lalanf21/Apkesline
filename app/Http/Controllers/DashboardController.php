<?php

namespace App\Http\Controllers;

use App\Model\DokterModel;
use App\Model\PasienModel;
use App\Model\UsersModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $dokter = DokterModel::count();
        $user = UsersModel::count();
        $pasien = PasienModel::count();
        return view('dashboard.dashboard', compact('dokter','pasien','user'));
    }

}
