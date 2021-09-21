@extends('layouts.master')
@section('title','Dashboard')
@section('content')
<div class="row">
    <div class="col-lg-4 col-sm-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <h4 class="text-sm mb-0 text-capitalize font-weight-bold">User</h4>
                <h3 class="font-weight-bolder mb-0">
                  {{ $user }}
                </h3>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="fas fa-users" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <h4 class="text-sm mb-0 text-capitalize font-weight-bold">Pasien</h4>
                <h3 class="font-weight-bolder mb-0">
                  {{ $pasien }}
                </h3>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="fas fa-user" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <h4 class="text-sm mb-0 text-capitalize font-weight-bold">Dokter</h4>
                <h3 class="font-weight-bolder mb-0">
                  {{ $dokter }}
                </h3>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="fas fa-user-md" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('after-script')

@endpush

