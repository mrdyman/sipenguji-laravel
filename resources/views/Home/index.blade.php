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
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
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
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Peta Gedung Ujian</h3>
                                <button class="btn btn-sm btn-flat btn-success" id="showPoly">Tampilkan Polyline</button>
                            </div>
                        </div>
                        <div class="card-body pt-2">
                            <div id="map" style="height: 300px;"></div>
                        </div>
                    </div>
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Data Gedung Ujian</h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-sm">
                                    <i class="fas fa-download"></i>
                                </a>
                                <a href="#" class="btn btn-tool btn-sm">
                                    <i class="fas fa-bars"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Jumlah Ruangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($gedung as $gedung)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $gedung['nama'] }}
                                        </td>
                                        <td>{{ $gedung['alamat'] }}</td>
                                        <td>{{ $gedung['jumlah_ruangan'] }}</td>
                                        <td>
                                            <a href="" class="badge badge-warning">detail</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
                <div class="col-lg-6">
                    <div class="card" style="height: 400px;">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Tambah Data</h3>
                            </div>
                            @if(session('status'))
                            <div class="alert alert-success col-sm-3">
                                {{ session('status') }}
                            </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ url('home') }}">
                                @csrf
                                <div class="form-group row mb-2">
                                    <label for="Nama" class="col-sm-2 col-form-label col-form-label-sm">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" id="Nama" placeholder="Nama Gedung" name="nama">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="alamat" class="col-sm-2 col-form-label col-form-label-sm">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" id="alamat" placeholder="Alamat Gedung" name="alamat">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="jumlah-ruangan" class="col-sm-2 col-form-label col-form-label-sm">Jumlah ruangan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" id="jumlah-ruangan" placeholder="Jumlah Ruangan" name="jumlah_ruangan">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="latitude" class="col-sm-2 col-form-label col-form-label-sm">Latitude</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" id="latitude" placeholder="Latitude" name="latitude">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="longitude" class="col-sm-2 col-form-label col-form-label-sm">Longitude</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" id="longitude" placeholder="Longitude" name="longitude">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2 col-form-label col-form-label-sm"></div>
                                    <button class="ml-2 btn btn-sm btn-info rounded-0" type="submit">Tambah</button>
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Data Ruangan Ujian</h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-sm">
                                    <i class="fas fa-download"></i>
                                </a>
                                <a href="#" class="btn btn-tool btn-sm">
                                    <i class="fas fa-bars"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Rute</th>
                                        <th>Jarak</th>
                                        <th>Koordinat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($polyline as $polyline)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $polyline['jalur'] }}
                                        </td>
                                        <td>{{ $polyline['jarak'] }}</td>
                                        <td>
                                            {{ $polyline['koordinat'] }}
                                        </td>
                                        <td>
                                            <a href="" class="badge badge-success">detail</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection