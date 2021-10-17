@extends('layouts.master')
@section('title','Data laporan topup pasien')
@section('breadcrumb','Laporan topup pasien')
@section('content')
<div class="card mb-5" style="width:100%;">
    <div class="card-body">
        <h2 class="card-title" style="color: black;">Laporan topup pasien</h2>
        <hr>
    </div>
</div>
 
@include('includes.alert')

<div class="row my-3">
 <div class="col-md-12">
    <div class="container bg-white p-4" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
        <form action="{{ route('filter') }}" method="get">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <select name="bulan" id="bulan" class="form-control">
                            <option value="">==PILIH BULAN==</option>
                            @for ($i = 1; $i <= 12; $i++ )
                            <option value="{{ $i }}"> {{ $i}} </option>
                            @endfor
                        </select>
                        @error('bulan')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <select name="tahun" id="tahun" class="form-control">
                            <option value="">==PILIH Tahun==</option>
                            @for ($i = $tahun_akhir; $i >= $tahun_awal; $i-- )
                            <option value="{{ $i }}"> {{ $i }} </option>
                            @endfor
                        </select>
                        @error('tahun')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter </button>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table id="dokter" class="table align-items-center table-flush">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama pasien</th>
                        <th scope="col">Nama admin</th>
                        <th scope="col">Nominal</th>
                    </tr>
                    @forelse ($laporan as $data)
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td> {{ $data->created_at->format('d M Y') }} </td>
                        <td> {{ $data->pasien->nama }} </td>
                        <td> {{ $data->users->nama }} </td>
                        <td> {{ 'Rp ' . number_format($data->nominal,'0','','.') }} </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5" align="center">Tidak ada data !</td>
                        </tr>
                    @endforelse
                </thead>
            </table>
            <h4 class="">
                Pendapatan bulan ini : Rp {{ number_format($total,'0','','.') }}
            </h4>
            {{ $laporan->links() }}
        </div>
    </div>
</div>  
    
</div>
@endsection

@push('after-script')

@endpush

