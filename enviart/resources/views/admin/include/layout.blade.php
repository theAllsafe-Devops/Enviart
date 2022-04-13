<!DOCTYPE html>
<html lang="ar" @if(session('type')==0) dir="ltr"  @endif>

<head>
    @include('admin.include.head')
</head>

<body class="g-sidenav-show  bg-gray-100  @if(session('type')==0) ltr  @endif">
    @include('admin.include.siderbar')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
     @include('admin.include.header')
    @yield('mainarea')
    <!-- End Navbar -->
  </main>
    @include('admin.include.footer')
    @include('admin.include.script') 

</body>

</html>