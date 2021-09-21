@extends('layouts.master')
@section('title','Tambah pasien')
@section('breadcrumb','Tambah pasien')
@section('content')
<div class="card" style="width:100%;">
    <div class="card-body">
        <h4 class="card-title" style="color: black;">Tambah pasien</h4>
        <hr>
    </div>
</div>

<div class="row my-2">
    <div class="col">
        <a href="{{ route('pasien.index') }}" class="btn btn-info"><i class="fas fa-arrow-left"></i> Kembali </a>
    </div>
</div>

<div class="row my-3 justify-content-center">
    <div class="col-md-8">
        <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('pasien.store') }}">
                    @method('post')
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama lengkap</label>
                        <input type="text" required autofocus class="form-control" name="nama">
                        @error('nama')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nik">Nomor KTP</label>
                        <input type="text" class="form-control" name="nik" required>
                        @error('nik')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control" required></textarea>
                        @error('alamat')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No hp</label>
                        <input type="text" class="form-control" name="no_hp" required>
                        @error('no_hp')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender_id">Jenis kelamin</label>
                        <select name="gender_id" id="gender_id" class="form-control">
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
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <div class="form-group">
                                <label for="kode_unik">kode unik</label>
                                <input type="text" name="kode_unik" value="{{ old('kode_unik') }}" class="form-control @error('kode_unik') is-invalid @enderror" readonly required>
                                @error('kode_unik')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 mt-3 p-3">
                            <a id="generate" href="" class="btn btn-primary ">
                               <i class="fas fa-sync"></i> Generate
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="saldo"> Saldo </label>
                        <input type="number" value="0" class="form-control" name="saldo" required>
                        <span class="text-muted">*Dalam satuan Rp</span>
                        @error('saldo')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan </button>
                        <a href="{{ route('pasien.create') }}" class="btn btn-warning"><i class="fas fa-redo-alt"></i> Reset </a>
                    </div>
                </form>
                </div>   
        </div>
    </div>
</div>
@endsection

@push('after-script')
<script>
    $("a#generate").click(function(e){
        e.preventDefault();
        const random = Math.random().toString(36).substr(2, 5)
        $('input[name=kode_unik]').val(random);
    });
</script>
@endpush

