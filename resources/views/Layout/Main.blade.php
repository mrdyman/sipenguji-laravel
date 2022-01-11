<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title id="title">@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ url('assets/vendor') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('assets/vendor') }}/dist/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ url('assets/vendor') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ url('assets/vendor') }}/plugins/toastr/toastr.min.css">
    <!-- Maps Script -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMiqfHPAc3Mn_JIjC5JOa0D85mGFpbUSs"></script>
    <script src="{{ url('assets/vendor') }}/dist/js/mapsscript.js"></script>
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed" onload="initMap()">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/') }}" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">


                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ url('assets/img/') }}/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light">SIPENGUJI</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ url('assets/img/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ session()->get('user')['username'] }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               @if(session()->get('user')['role'] == 0)
                        <li class="nav-item dashboard menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('') }}" class="nav-link side-title-home">
                                        <i class="fas fa-home nav-icon"></i>
                                        <p>Home</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/polyline')}}" class="nav-link side-title-polyline">
                                        <i class="fas fa-map-marked-alt nav-icon"></i>
                                        <p>Polyline</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/floyd-warshall')}}" class="nav-link side-title-floyd-warshall">
                                        <i class="fas fa-route nav-icon"></i>
                                        <p>Floyd-Warshall</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                @endif
                        <li class="nav-header">Mahasiswa</li>
                @if(session()->get('user')['role'] == 0)
                        <li class="nav-item">
                            <a href="{{ url('/home/mahasiswa') }}" class="nav-link side-title-data-mahasiswa">
                                <i class="nav-icon fas fa-database"></i>
                                <p>Data Mahasiswa</p>
                            </a>
                        </li>
                @endif
                @if(session()->get('user')['role'] == 1)
                        <li class="nav-item">
                            <a href="{{ url('/mahasiswa/biodata') }}" class="nav-link side-title-biodata">
                                <i class="nav-icon fas fa-graduation-cap"></i>
                                <p>Biodata</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/mahasiswa/cetak') }}" class="nav-link side-title-cetak-kartu">
                                <i class="nav-icon fas fa-print"></i>
                                <p>Cetak Kartu</p>
                            </a>
                        </li>
                @endif
                        <a href="{{ url('auth/logout') }}" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                            <p class="text">Logout</p>
                        </a>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('content')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2021 <a href="https://mrdyman.github.io">Sipenguji</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ url('assets/vendor') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ url('assets/vendor') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="{{ url('assets/vendor') }}/dist/js/adminlte.js"></script>
    <!-- SweetAlert2 -->
    <script src="{{ url('assets/vendor') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="{{ url('assets/vendor') }}/plugins/toastr/toastr.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ url('assets/vendor') }}/dist/js/demo.js"></script>

    {{-- DataTables --}}
    <script src="{{ url('assets/vendor') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('assets/vendor') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('assets/vendor') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('assets/vendor') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ url('assets/vendor') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('assets/vendor') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ url('assets/vendor') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('assets/vendor') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ url('assets/vendor') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- script to organize data CRUD -->
    <script src="{{ url('assets/vendor') }}/dist/js/sidebar-script.js"></script>
    <script src="{{ url('assets/vendor') }}/dist/js/myscript.js"></script>
    <script src="{{ url('assets/vendor') }}/dist/js/polyline.js"></script>
    <script src="{{ url('assets/vendor') }}/dist/js/floyd-warshall.js"></script>

</body>

</html>
<script>
  $(function () {
    $('#table-gedung').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('#table-ruangan').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('#table-polyline').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('#table-jadwal').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('#table-rute-terpendek').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>