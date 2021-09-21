<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="" >
        {{-- <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo"> --}}
        <span class="ms-1 font-weight-bold">Apkesline Dashboard</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link  active" href="{{ route('dashboard') }}">
            <span class="nav-link-text ms-1"><i class="fas fa-tachometer-alt"></i> Dashboard</span>
          </a>
        </li>
        @if(Auth()->user()->level_user_id === 1)
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Data master</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('pasien.index') }}">
            <span class="nav-link-text ms-1"> <i class="fas fa-user"></i> Data pasien</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('dokter.index') }}">
            <span class="nav-link-text ms-1"> <i class="fas fa-user-md"></i> Data dokter</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('users.index') }}">
            <span class="nav-link-text ms-1"> <i class="fas fa-users"></i> Data user</span>
          </a>
        </li>
        
        @else
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">
            Laporan
          </h6>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">
            <span class="nav-link-text ms-1"> <i class="fas fa-users"></i> Kunjungan pasien</span>
          </a>
        </li>

        @endif

      </ul>
    </div>
    
    <div class="sidenav-footer mx-3 ">
      <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class=" btn bg-gradient-primary mt-4 w-100">
            <i class="fas fa-sign-out-alt"></i> Logout
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>
    </div>
  </aside>