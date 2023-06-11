@include('admin.components.header.header')
<div class="body-wrapper">

    <!-- partial:partials/_sidebar.html -->
    @include('admin.components.sidebar.sidebar')

    <!-- partial -->
    <div class="main-wrapper mdc-drawer-app-content">
      <!-- partial:partials/_navbar.html -->
      @include('admin.components.navbar.navbar')

      <!-- partial -->
      <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper">

            {{-- HERE IS THE MAIN CONTENT ARE PLACED --}}
            @yield('main-content')


        </main>

@include('admin.components.footer.footer');
