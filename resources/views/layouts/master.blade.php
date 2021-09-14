<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title')
    </title>

    {{-- style --}}
    @stack('before-style')
    @include('includes.style')
    @stack('after-style')

</head>

<body class="g-sidenav-show  bg-gray-100">
  
  {{-- sidebar --}}
  @include('includes.sidebar')
  {{-- /sidebar --}}

    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

  {{-- navbar --}}
    @include('includes.navbar')
  {{-- /navbar --}}

      {{-- main --}}
      <div class="container-fluid py-4">
        @yield('content')
      </div>
        
    </main>
    {{-- /main --}}

    @include('includes.settings')

    @stack('before-script')
    @include('includes.script')
    @stack('after-script')
    
  </body>
</html>

