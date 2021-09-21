<?php

namespace App\Http\Controllers;

use App\Model\DokterModel;
use App\Model\GenderModel;
use App\Model\SpesialisModel;
use App\Model\UsersModel;
use Illuminate\Http\Request;
use DataTables;

class DokterController extends Controller
{
    public function index()
    {
        return view('master.dokter.index');
    }

    public function create()
    {
        
        $spesialis = SpesialisModel::all();
        $gender = GenderModel::all();
        return view('master.dokter.form_add', compact('gender','spesialis'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'nama' => 'required',
                'gender_id' => 'required|numeric',
                'password' => 'required',
                'nip' => 'required',
                'no_hp' => 'required|numeric',
                'spesialis_id' => 'required|numeric',
                'biaya_charge' => 'required|numeric',
                'durasi' => 'required|numeric',
            ],
            [
                'required' => 'Wajib di isi !',
                'numeric' => 'Isi dengan angka !'
            ]);
            
            // store data users
            $data['nama'] = $request->nama;
            $data['username'] = $request->username;
            $data['password'] = Hash::make($request->password);
            $data['gender_id'] = $request->gender_id;
            $data['level_user_id'] = 3;
            $data['status_id'] = 10;
            $users = UsersModel::create($data);

            // store data dokter
            $dataDokter['nip'] = $request->nip;
            $dataDokter['spesialis_id'] = $request->spesialis_id;
            $dataDokter['biaya_charge'] = $request->biaya_charge;
            $dataDokter['durasi'] = $request->durasi;
            $dataDokter['no_hp'] = $request->no_hp;
            $dataDokter['users_id'] = $users->id;
            $dokter = DokterModel::create($dataDokter);

            if (!$users->id || !$dokter->id) {    
                session()->flash('error', 'Data gagal di simpan ');
            }else{
                session()->flash('success', 'Data berhasil di simpan ');
            }
            
            return redirect()->route('dokter.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = DokterModel::where('users_id',$id)->firstOrFail();
        $spesialis = SpesialisModel::get();
        return view('master.dokter.form_edit', compact('data','spesialis'));
    }

    public function update(Request $request, $id)
    {
        $data = DokterModel::where('id',$id)->firstOrFail();

        // dd($request->all());

        $request->validate(
        [
            'nip' => 'required|max:15',
            'no_hp' => 'required|numeric',
            'spesialis_id' => 'required',
            'biaya_charge' => 'required|numeric',
            'durasi' => 'required|numeric',
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
        return redirect()->route('dokter.index');


    }

    public function destroy($id)
    {
        $data = UsersModel::where('id',$id)->firstOrFail();
        $data->update(['status_id'=> 2]);
        if (!$data->wasChanged()) {    
            session()->flash('error', 'Data gagal di hapus ');
        }else{
            session()->flash('success', 'Data berhasil di hapus ');
        }

        return redirect()->route('dokter.index');
    }

    public function list_dokter()
    {
        // $item = UsersModel::with(['spesialis','users.gender','users.status'])->get();
        $item = UsersModel::with(['dokter','dokter.spesialis','status','gender'])->where([
            ['status_id','!=',2],
            ['level_user_id','=',3]
        ])->get();
        return DataTables::of($item)
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->addColumn('action', function ($item) {
                $action = '<a href="/dokter/'.$item->id.'/edit" class="btn btn-warning btn-sm"> <i class="fas fa-edit"></i> Edit</a>';
                $action .= ' | <form action="/dokter/'.$item->id.'" method="post" class="d-inline">'
                .csrf_field().method_field("delete").'
                <button onclick="return confirm(\'Anda yakin ?\')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button></form>';
                return $action;
            })
            ->make(true);
    }
}
