@extends('layout.main')

@section('title', 'SIPENGUJI | Polyline')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        <div class="card-header border-0 pb-2">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Peta Polyline</h3>
                                <button href="" id="show-polyline" onclick="displayPolyline()" class="btn btn-sm btn-warning">Tampilkan Polyline</button>
                            </div>
                        </div>
                        <div class="card-body pt-1">
                            <div id="map" style="height: 500px;"></div>
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
                        <div class="card-header border-0">
                            <h3 class="card-title">Data Polyline</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle" id="table-polyline">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Titik Awal</th>
                                        <th>Titik Tujuan</th>
                                        <th>Jalur</th>
                                        <th>Koordinat</th>
                                        <th>Jarak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($polyline as $p)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $p['titik_awal'] }}
                                        </td>
                                        <td>{{ $p['titik_tujuan'] }}</td>
                                        <td>
                                            {{ $p['jalur'] }}
                                        </td>
                                        <?php if (strlen($p['koordinat']) > 20) { ?>
                                            <td>{{ substr($p['koordinat'], 0, 19) }}</td>
                                            <?php } else { ?>
                                            <td>{{ $p['koordinat'] }}</td>
                                            <?php } ?>
                                        <td>
                                            {{ $p['jarak'] }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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