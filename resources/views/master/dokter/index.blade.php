@extends('layouts.master')
@section('title','Data dokter')
@section('breadcrumb','Data dokter')
@section('content')
<div class="card" style="width:100%;">
    <div class="card-body">
        <h2 class="card-title" style="color: black;">Management dokter</h2>
        <hr>
        <a href="{{ route('users.create') }}" class="btn bg-gradient-primary">Tambah Data</a>
    </div>
</div>
 
@include('alert')

<div class="row">
 <div class="col-md-12">
    <div class="container bg-white p-4" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
        <div class="table-responsive">
            <table id="dokter" class="table align-items-center table-flush">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Nama</th>
                        <th scope="col">No Hp</th>
                        <th scope="col">Jenis kelamin</th>
                        <th scope="col">Spesialis</th>
                        <th scope="col">Jasa dokter</th>
                        <th scope="col">Durasi Konsultasi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>  
    
</div>
@endsection

@push('after-script')
<script>
    $(function() {
        $('#dokter').DataTable({
            processing: true
            , serverSide: true
            , ajax: "{{ @route('list-dokter') }}",
            dom: 'Bfrtlip',
            buttons: [
                {
                    extend: 'print',
                    exportOptions: 
                    {
                        columns: [ 0,1,2,3,4,5,6]
                    },
                }, 
                {
                    extend: 'excel',
                    exportOptions: 
                    {
                        columns: [ 0,1,2,3,4,5,6]
                    },
                }, 
                {
                    extend: 'pdf',
                    exportOptions: 
                    {
                        columns: [ 0,1,2,3,4,5,6]
                    },
                }, 
            ],
            columns: [
                {
                    data: 'DT_RowIndex'
                }, 
                {
                    data: 'nip'
                }, 
                {
                    data: 'users.nama'
                }, 
                {
                    data: 'no_hp'
                },
                {
                    data: 'users.gender.gender'
                },
                {
                    data: 'spesialis.nama_spesialis'
                },
                {
                    data: 'biaya_charge'
                }
                ,
                {
                    data: 'durasi'
                }
                ,
                {
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                    , searchable: false
                },
            ]
        });
    });

</script>

@endpush

