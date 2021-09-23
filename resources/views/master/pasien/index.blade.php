@extends('layouts.master')
@section('title','Data pasien')
@section('breadcrumb','Data pasien')
@section('content')
<div class="card" style="width:100%;">
    <div class="card-body">
        <h2 class="card-title" style="color: black;">Management pasien</h2>
        <hr>
        <a href="{{ route('pasien.create') }}" class="btn bg-gradient-primary">Tambah Data</a>
    </div>
</div>
 
@include('includes.alert')

<div class="row">
 <div class="col-md-12">
    <div class="container bg-white p-4" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
        <div class="table-responsive">
            <table id="pasien" class="table align-items-center table-flush">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">No Hp</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Jenis kelamin</th>
                        <th scope="col">Kode unik</th>
                        <th scope="col">Saldo</th>
                        <th scope="col">Status</th>
                        <th scope="col">Topup</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>  

{{-- modal topup --}}
<div class="modal fade" id="topupModal" tabindex="-1" role="dialog" aria-labelledby="topupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="topupModalLabel">Topup saldo pasien</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('topup') }}" method="POST">
        @method('post')
        @csrf
        <input type="hidden" name="pasien_id" id="pasienId" value="">
        <label for="nominal">Nominal Topup</label>
        <input type="number" name="nominal" id="nominal" class="form-control">
        <span class="text-muted">*Dalam satuan Rp</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-gradient-primary">  <i class="fas fa-save"></i> Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- /modal topup --}}

@endsection

@push('after-script')
<script>
    $(document).on("click", ".topupModal", function () {
     var pasienId = $(this).data('id');
     $(".modal-body #pasienId").val( pasienId );
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
</script>
<script>
    $(function() {
        $('#pasien').DataTable({
            processing: true
            , serverSide: true
            , ajax: "{{ @route('list-pasien') }}",
            columns: [
                {
                    data: 'DT_RowIndex'
                }, 
                {
                    data: 'nik'
                }, 
                {
                    data: 'nama'
                }, 
                {
                    data: 'no_hp'
                },
                {
                    data: 'alamat'
                },
                {
                    data: 'gender.gender'
                },
                {
                    data: 'kode_unik'
                },
                {
                    data: 'saldo'
                },
                {
                    data: 'status.status'
                }
                ,
                {
                    data: 'topup',
                    orderable: false,
                    searchable: false
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

