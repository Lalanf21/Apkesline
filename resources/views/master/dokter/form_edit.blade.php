@extends('layouts.master')
@section('title','Data dokter')
@section('breadcrumb','Data dokter')
@section('content')
<div class="card" style="width:100%;">
    <div class="card-body">
        <h4 class="card-title" style="color: black;">Edit dokter</h4>
        <hr>
    </div>
</div>
 @if (session('status'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('status') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
@endif
<div class="row my-3 justify-content-center">
    <div class="col-md-8">
        <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('dokter.update',$data->id) }}">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" value="{{ $data->nip }}" class="form-control" name="nip">
                        @error('nip')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No hp</label>
                        <input type="text" value="{{ $data->no_hp }}" class="form-control" name="no_hp">
                        @error('no_hp')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="spesialis">spesialis</label>
                        <select name="spesialis_id" id="spesialis" class="form-control">
                            @foreach($spesialis as $value)
                                <option value="{{ $value->id }}"  {{ ($value->id===$data->spesialis_id) ? 'selected' : '' }} >
                                    {{ $value->nama_spesialis }}
                                </option>
                            @endforeach
                        </select>
                        @error('spesialis_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="biaya_charge"> Jasa dokter* </label>
                        <input type="text" value="{{ $data->biaya_charge }}" class="form-control" name="biaya_charge">
                        <div class="text-muted"> *Dalam satuan Rp </div>
                        @error('biaya_charge')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="durasi">Durasi konsultasi* </label>
                        <input type="text" value="{{ $data->durasi }}" class="form-control" name="durasi">
                        <span class="text-muted">*Dalam satuan menit</span>
                        @error('durasi')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-warning"><i class="fas fa-edit"></i> Update </button>
                    </div>
                </form>
                </div>   
        </div>
    </div>
</div>
@endsection

@push('after-script')
@endpush

