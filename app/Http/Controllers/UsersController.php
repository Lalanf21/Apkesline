<?php

namespace App\Http\Controllers;

use App\Model\DokterModel;
use App\Model\GenderModel;
use App\Model\LevelUsersModel;
use App\Model\SpesialisModel;
use App\Model\UsersModel;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    
    public function index()
    {
        return view('master.users.index');
    }

    
    public function create()
    {
        $spesialis = SpesialisModel::all();
        $gender = GenderModel::all();
        $level = LevelUsersModel::all();
        return view('master.users.form_add', compact('gender','level','spesialis'));
    }

    
    public function store(Request $request)
    {
        if ($request->filled('nip')) {
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
        }else{
            $request->validate(
            [
                'username' => 'required',
                'nama' => 'required',
                'gender_id' => 'required|numeric',
                'password' => 'required',
                'level_user_id' => 'required|numeric',
            ],
            [
                'required' => 'Wajib di isi !',
                'numeric' => 'Isi dengan angka !'
            ]);

            $data['nama'] = $request->nama;
            $data['username'] = $request->username;
            $data['password'] = Hash::make($request->password);
            $data['gender_id'] = $request->gender_id;
            $data['level_user_id'] = $request->level_user_id;
            $data['status_id'] = 10;
            $users = UsersModel::create($data);
        }

        if (!$users->id || !$dokter->id) {    
            session()->flash('error', 'Data gagal di simpan ');
        }else{
            session()->flash('success', 'Data berhasil di simpan ');
        }
        
        return redirect()->route('users.index');

    }

    
    public function show($id)
    {
        //
    }
    
    
    public function edit($id)
    {
        $data = UsersModel::where('id',$id)->firstOrFail();
        $spesialis = SpesialisModel::all();
        $gender = GenderModel::all();
        $level = LevelUsersModel::all();
        return view('master.users.form_edit', compact('data','gender','level','spesialis'));
    }

    
    public function update(Request $request, $id)
    {   
        $data = UsersModel::where('id',$id)->firstOrFail();
        if ($request->level_user_id != 3) {
            $data->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'gender_id' => $request->gender_id,
                'level_user_id' => $request->level_user_id
            ]);
            $dokter = DokterModel::where('users_id', $id)->firstOrFail();
            $dokter->delete();
        }else{
            $data->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'gender_id' => $request->gender_id,
                'level_user_id' => $request->level_user_id
            ]);

            // store data dokter
            $dataDokter['nip'] = $request->nip;
            $dataDokter['spesialis_id'] = $request->spesialis_id;
            $dataDokter['biaya_charge'] = $request->biaya_charge;
            $dataDokter['durasi'] = $request->durasi;
            $dataDokter['no_hp'] = $request->no_hp;
            $dataDokter['users_id'] = $id;

            DokterModel::create($dataDokter);
            if (!$data->wasChanged()) {    
                session()->flash('error', 'Data gagal di hapus ');
            }else{
                session()->flash('success', 'Data berhasil di hapus ');
            }
        }

        return redirect()->route('users.index');
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
        return redirect()->route('users.index');
    }

    public function list_users()
    {
        $item = UsersModel::with(['gender','level_user'])->where('status_id','!=',2)->get();
        return DataTables::of($item)
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->addColumn('action', function ($item) {
                $action = '<a href="/users/'.$item->id.'/edit" class="btn btn-warning btn-sm"> <i class="fas fa-edit"></i> Edit</a>';
                $action .= ' | <form action="/users/'.$item->id.'" method="post" class="d-inline">'
                .csrf_field().method_field("delete").'
                <button onclick="return confirm(\'Anda yakin ?\')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button></form>';
                return $action;
            })
            ->make(true);
    }
}
