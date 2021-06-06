@extends('layout.main')

@section('title', 'Home')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Polyline</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Polyline</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content" onload="initMap()">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Peta Polyline</h3>
                                <a href="#">Tampilkan Polyline</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <div id="map" style="height: 500px;"></div>

                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square text-primary"></i> Baru Ditambahkan
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->

                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Polyline</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Jalur</th>
                                        <th>Koordinat</th>
                                        <th>Jarak</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Ekonomi - Teknik</td>
                                        <td>11-7-2014</td>
                                        <td>7</td>
                                        <td>
                                            <a href="#" class="badge badge-warning">edit</a>
                                            <a href="#" class="badge badge-danger">hapus</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Ekonomi - Teknik</td>
                                        <td>11-7-2014</td>
                                        <td>7</td>
                                        <td>
                                            <a href="#" class="badge badge-warning">edit</a>
                                            <a href="#" class="badge badge-danger">hapus</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Ekonomi - Teknik</td>
                                        <td>11-7-2014</td>
                                        <td>7</td>
                                        <td>
                                            <a href="#" class="badge badge-warning">edit</a>
                                            <a href="#" class="badge badge-danger">hapus</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Ekonomi - Teknik</td>
                                        <td>11-7-2014</td>
                                        <td>7</td>
                                        <td>
                                            <a href="#" class="badge badge-warning">edit</a>
                                            <a href="#" class="badge badge-danger">hapus</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Ekonomi - Teknik</td>
                                        <td>11-7-2014</td>
                                        <td>7</td>
                                        <td>
                                            <a href="#" class="badge badge-warning">edit</a>
                                            <a href="#" class="badge badge-danger">hapus</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Ekonomi - Teknik</td>
                                        <td>11-7-2014</td>
                                        <td>7</td>
                                        <td>
                                            <a href="#" class="badge badge-warning">edit</a>
                                            <a href="#" class="badge badge-danger">hapus</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Ekonomi - Teknik</td>
                                        <td>11-7-2014</td>
                                        <td>7</td>
                                        <td>
                                            <a href="#" class="badge badge-warning">edit</a>
                                            <a href="#" class="badge badge-danger">hapus</a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/ col-md-6 -->
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Data</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="source">Titik Awal</label>
                                    <input type="text" class="form-control" id="source" placeholder="Masukkan titik awal">
                                </div>
                                <div class="form-group">
                                    <label for="destination">Titik Tujuan</label>
                                    <input type="text" class="form-control" id="destination" placeholder="Masukkan titik tujuan">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--/ col-md-6 -->

            </div>
            <!--/ row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection