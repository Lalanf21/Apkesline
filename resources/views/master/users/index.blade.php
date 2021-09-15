@extends('layouts.master')
@section('title','Data users')
@section('breadcrumb','Data users')
@section('content')
<div class="card" style="width:100%;">
    <div class="card-body">
        <h2 class="card-title" style="color: black;">Management users</h2>
        <hr>
        <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah Data</a>
    </div>
</div>
 @if (session('status'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="fas fa-check"></i></span>
                <span class="alert-text"><strong>{{ session('status') }}!</strong></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
@endif
<div class="row">
 <div class="col-md-12">
    <div class="container bg-white p-4" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
        <div class="table-responsive">
            <table id="users" class="table align-items-center table-flush">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis kelamin</th>
                        <th scope="col">Level</th>
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
        $('#users').DataTable({
            processing: true
            , serverSide: true
            , ajax: "{{ @route('list-users') }}",
            dom: 'Bfrtlip',
            buttons: [
                {
                    extend: 'print',
                    exportOptions: 
                    {
                        columns: [ 0,1,2,3,4]
                    },
                }, 
                {
                    extend: 'excel',
                    exportOptions: 
                    {
                        columns: [ 0,1,2,3,4]
                    },
                }, 
                {
                    extend: 'pdf',
                    exportOptions: 
                    {
                        columns: [ 0,1,2,3,4]
                    },
                }, 
            ],
            columns: [
                {
                    data: 'DT_RowIndex'
                }, 
                {
                    data: 'username'
                }, 
                {
                    data: 'nama'
                }, 
                {
                    data: 'gender.gender'
                },
                {
                    data: 'level_user.level_name'
                },
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

