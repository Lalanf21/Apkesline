<?php

namespace App\Http\Controllers;

use App\Model\GenderModel;
use App\Model\PasienModel;
use Illuminate\Http\Request;
use DataTables;

class PasienController extends Controller
{
    public function index()
    {
        return view('master.pasien.index');
    }

    public function create()
    {
        $gender = GenderModel::all();
        return view('master.pasien.form_add', compact('gender'));
    }

    public function store(Request $request)
    {
        $request->validate(
        [
            'nama' => 'required',
            'alamat' => 'required',
            'nik' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'gender_id' => 'required',
            'kode_unik' => 'required',
            'saldo' => 'required|numeric',
        ],
        [
            'required' => 'Wajib di isi !',
            'numeric' => 'Isi dengan angka !'
        ]);

        $data = $request->all();

        PasienModel::create($data);

        return redirect()->route('pasien.index')->with('status', 'Berhasil di Simpan !');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = PasienModel::where('id',$id)->first();
        $gender = GenderModel::get();
        return view('master.pasien.form_edit', compact('data','gender'));
    }

    public function update(Request $request, $id)
    {
        $data = PasienModel::where('id',$id)->first();

        $request->validate(
        [
            'nama' => 'required',
            'alamat' => 'required',
            'nik' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'gender_id' => 'required',
            'kode_unik' => 'required',
            'saldo' => 'required|numeric',
        ],
        [
            'required' => 'Wajib di isi !',
            'numeric' => 'Isi dengan angka !'
        ]);

        $data->update($request->all());
        return redirect()->route('pasien.index')->with('status', 'Berhasil di Update !');
    }

    public function destroy($id)
    {
        $data = PasienModel::where('id',$id)->first();
        $data->delete();
        return redirect()->route('pasien.index')->with('status', 'Berhasil di Hapus !');
    }

    public function list_pasien()
    {
        $item = PasienModel::with('gender')->get() ;
        return DataTables::of($item)
            ->rawColumns(['action','topup'])
            ->addIndexColumn()
            ->addColumn('action', function ($item) {
                $action = '<a href="/pasien/'.$item->id.'/edit" class="btn btn-warning btn-sm"> <i class="fas fa-edit"></i> Edit</a>';
                $action .= ' | <form action="/pasien/'.$item->id.'" method="post" class="d-inline">'
                .csrf_field().method_field("delete").'
                <button onclick="return confirm(\'Anda yakin ?\')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button></form>';
                return $action;
            })
            ->addColumn('topup', function($item){
                return '<button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-light"><i class="fas fa-wallet"></i></button>';
            })
            ->make(true);
    }
}
