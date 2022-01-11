@extends('layout.main')

@section('title', 'SIPENGUJI | Floyd Warshall')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Floyd-Warshall</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Floyd-Warshall</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content" onload="initMap()">
        <div class="row ml-2 mb-2">
            <select class="mr-2 select-ruangan-source" id="select-ruangan-source" name="jenis_ujian_jadwal">
                {{-- {{-- this populated with ajax --}}
            </select>
            <select class="select-ruangan-destination" id="select-ruangan-destination" name="jenis_ujian_jadwal">
                {{-- this populated with ajax --}}
            </select>
            <button type="submit" class="ml-2 btn btn-sm btn-flat btn-success btn-hitung" onclick="floyd_Warshall()">Hitung</button>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header border-0 pb-2">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Simulasi Algoritma Floyd-Warshall</h3>
                                <button href="" id="show-polyline" onclick="displayPolyline()" class="btn btn-sm btn-warning">Tampilkan Polyline</button>
                            </div>
                        </div>
                        <div class="card-body pt-1">
                            <div id="map" style="height: 500px;"></div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-lg">
                    <div class="card">
                        <div class="card-header border-0 pb-2">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title"><b>Hasil Perhitungan Algoritma</b></h3>
                            </div>
                        </div>
                        <div class="card-body pt-1">
                            <label for="polyline_koordinat">Rute yang dilalui :</label>
                                <textarea class="form-control" id="rute"></textarea>
                        </div>
                        <div class="card-body pt-1">
                            <div class="row">
                                <label for="polyline_koordinat">Jarak :</label>
                                <input type="text" class="form-control-sm form-control col-sm ml-3" id="jarak" name="jarak" disabled>
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
                <div class="col-md">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Rute Terpendek</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap" id="table-rute-terpendek">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Titik Awal</th>
                                        <th>Titik Tujuan</th>
                                        <th>Rute</th>
                                        <th>Jarak</th>
                                        <th>Koordinat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($hasil_floyd as $hasil)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $hasil['titik_awal'] }}</td>
                                        <td>{{ $hasil['titik_tujuan'] }}</td>
                                        <td>{{ $hasil['rute'] }}</td>
                                        <td>{{ $hasil['jarak'] }}</td>
                                        <?php if (strlen($hasil['koordinat']) > 30) { ?>
                                            <td>{{ substr($hasil['koordinat'], 0, 29) }}</td>
                                            <?php } else { ?>
                                            <td>{{ $hasil['koordinat'] }}</td>
                                            <?php } ?>
                                        <td>
                                            <a href="#" class="badge badge-danger hapus_hasil" id="{{ $hasil['id'] }}">hapus</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!--/ row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection