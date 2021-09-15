<?php

namespace App\Http\Controllers;

use App\Model\GenderModel;
use App\Model\LevelUsersModel;
use App\Model\SpesialisModel;
use App\Model\UsersModel;
use Illuminate\Http\Request;
use DataTables;

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
        //
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        $data = UsersModel::where('id',$id)->first();
        $data->delete();
        return redirect()->route('users.index')->with('status', 'Berhasil di Hapus !');
    }

    public function list_users()
    {
        $item = UsersModel::with(['gender','level_user'])->get();
        return DataTables::of($item)
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->addColumn('action', function ($item) {
                $action = '<a href="/users/'.$item->id.'/edit" class="btn btn-warning btn-sm"> <i class="fas fa-edit"></i> Update</a>';
                $action .= ' | <form action="/users/'.$item->id.'" method="post" class="d-inline">'
                .csrf_field().method_field("delete").'
                <button onclick="return confirm(\'Anda yakin ?\')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button></form>';
                return $action;
            })
            ->make(true);
    }
}
