<?php

namespace App\Http\Controllers;

use App\Model\GenderModel;
use App\Model\PasienModel;
use App\Model\StatusModel;
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
        $data['status_id'] = 1;

        $newData = PasienModel::create($data);
        if (!$newData->id) {    
            session()->flash('error', 'Data gagal di simpan ');
        }else{
            session()->flash('success', 'Data berhasil di simpan ');
        }

        return redirect()->route('pasien.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = PasienModel::where('id',$id)->first();
        $gender = GenderModel::get();
        $status = StatusModel::whereIn('id', [10, 4, 1])->get();
        // dd($status);
        return view('master.pasien.form_edit', compact('data','gender','status'));
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
            'status_id' => 'required',
            'kode_unik' => 'required',
            'saldo' => 'required|numeric',
        ],
        [
            'required' => 'Wajib di isi !',
            'numeric' => 'Isi dengan angka !'
        ]);

        $data->update($request->all());
        if (!$data->wasChanged()) {    
            session()->flash('error', 'Data gagal di edit ');
        }else{
            session()->flash('success', 'Data berhasil di edit ');
        }
        return redirect()->route('pasien.index');
    }

    public function destroy($id)
    {
        $data = PasienModel::where('id',$id)->first();
        $data->update(['status_id'=> 2]);
        if (!$data->wasChanged()) {    
            session()->flash('error', 'Data gagal di hapus ');
        }else{
            session()->flash('success', 'Data berhasil di hapus ');
        }
        return redirect()->route('pasien.index');
    }

    public function list_pasien()
    {
        $item = PasienModel::with(['gender','status'])->where('status_id','!=','2')->get() ;
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
