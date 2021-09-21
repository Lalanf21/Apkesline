@extends('layouts.master')
@section('title','Tambah users')
@section('breadcrumb','Tambah users')
@section('content')
<div class="card" style="width:100%;">
    <div class="card-body">
        <h4 class="card-title" style="color: black;">Tambah users</h4>
        <hr>
    </div>
</div>
 
 <div class="row my-2">
    <div class="col">
        <a href="{{ route('users.index') }}" class="btn btn-info"><i class="fas fa-arrow-left"></i> Kembali </a>
    </div>
</div>


<div class="row my-3 justify-content-center">
    <div class="col-md-12">
        <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}">
                    @method('post')
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" autofocus class="form-control" name="username" value="{{ old('username') }}" required >
                                @error('username')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" required >
                                @error('nama')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="gender_id">Jenis kelamin</label>
                                <select name="gender_id" id="gender_id" class="form-control">
                                    <option value="">==PILIH==</option>
                                    @foreach($gender as $value)
                                        <option value="{{ $value->id }}" >
                                            {{ $value->gender }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('gender_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" required >
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="level_user_id"> Level </label>
                        <select name="level_user_id" id="level_user_id" class="form-control"  onchange="DokterForm()" >
                            <option value="">==PILIH==</option>    
                        @foreach($level as $value)
                            <option value="{{ $value->id }}" >
                                {{ $value->level_name }}
                            </option>
                        @endforeach
                        </select>
                        @error('level_user_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="dokter">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input type="text" class="form-control" name="nip" value="{{ old('nip') }}" >
                                    @error('nip')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="no_hp">No hp</label>
                                    <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp') }}" >
                                    @error('no_hp')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label for="spesialis_id"> Spesialis </label>
                            <select name="spesialis_id" id="spesialis_id" class="form-control">
                            <option value=""> ==PILIH== </option>
                                @foreach($spesialis as $value)
                                    <option value="{{ $value->id }}" >
                                        {{ $value->nama_spesialis }}
                                    </option>
                                @endforeach
                            </select>
                            @error('spesialis_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="biaya_charge"> Jasa dokter* </label>
                                    <input type="number" class="form-control" name="biaya_charge" value="{{ old('biaya_charge') }}" >
                                    <div class="text-muted"> *Dalam satuan Rp </div>
                                    @error('biaya_charge')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="durasi">Durasi konsultasi* </label>
                                    <input type="number" class="form-control" name="durasi" value="{{ old('durasi') }}" >
                                    <span class="text-muted">*Dalam satuan menit</span>
                                    @error('durasi')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan </button>
                    </div>
                </form>
                </div>   
        </div>
    </div>
</div>
@endsection

@push('after-script')
<script>
    $("#dokter").hide();

    function DokterForm(){
        var level = $("#level_user_id").val();

        if(level == 3){
          $("#dokter").show();
        }else{
          $("#dokter").hide();
        }

    }
</script>
@endpush

