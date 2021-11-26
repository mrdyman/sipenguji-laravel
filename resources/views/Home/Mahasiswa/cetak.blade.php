@extends('layout.main')

@section('title', 'SIPENGUJI | Cetak Kartu')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="session-success" data-flashsuccess="{{ session('status') }}"></div>
    <div class="session-error" data-flasherror="{{ session('error') }}"></div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cetak Kartu Ujian</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Mahasiswa</a></li>
                        <li class="breadcrumb-item active">Cetak Kartu</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="col-lg-7">
                @if($dataMahasiswa)
                    @if($dataMahasiswa['data']['is_bayar'] == 1)
                    <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Cetak Kartu Peserta Ujian SMMPTN</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="/mahasiswa/cetak" method="POST" class="form-horizontal">
                        @csrf
                        <div class="card-body">
                        <div class="form-group row">
                            <label for="nisn" class="col-sm-3 col-form-label">STATUS BAYAR</label>
                            <div class="col-sm-9">
                            <input type="label" class="form-control" id="nisn" name="nisn" placeholder="SUDAH BAYAR" disabled>
                            </div>
                        </div>

                        <div class="map" id="map"></div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-print"></i> Cetak Kartu Peserta</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                    </div>
                    @else
                    <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Cetak Kartu Peserta Ujian SMMPTN</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="/mahasiswa/bayar" method="POST" class="form-horizontal">
                        @method('put')
                        @csrf
                        <div class="card-body">
                        <div class="form-group row">
                            <label for="nisn" class="col-sm-3 col-form-label">STATUS BAYAR</label>
                            <div class="col-sm-9">
                            <input type="label" class="form-control" id="nisn" name="nisn" placeholder="BELUM BAYAR" disabled>
                            </div>
                        </div>
                        <p>Mohon untuk menyelesaikan pembayaran biaya pendaftaran pada nomor Virtual Account berikut : <b><u>7601053212335146<u><b></p>

                        <div class="map" id="map"></div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-dollar-sign"></i> Bayar</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                    </div>
                    @endif
                @else
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Silahkan mengisi Biodata terlebih dahulu</h3>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection