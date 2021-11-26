@extends('layout.main')

@section('title', 'SIPENGUJI | Biodata')

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
                    <h1 class="m-0">Biodata Mahasiswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Mahasiswa</a></li>
                        <li class="breadcrumb-item active">Biodata Mahasiswa</li>
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
                <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Biodata</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="/mahasiswa" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nisn" class="col-sm-2 col-form-label">NISN</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nisn" name="nisn" placeholder="Nomor Induk Siswa Nasional">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nik" class="col-sm-2 col-form-label">Jurusan</label>
                        <div class="col-sm-10">
                            <select class="custom-select mb-3" name="jurusan">
                                <option selected>--- Pilih Jurusan ---</option>
                                <option value="S1 - Teknik Informatika">S1 - Teknik Informatika</option>
                                <option value="S1 - Teknik Elektro">S1 - Teknik Elektro</option>
                                <option value="S1 - Sistem Informasi">S1 - Sistem Informasi</option>
                                <option value="D3 - Teknik Listrik">D3 - Teknik Listrik</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label">Pas Foto</label>
                        <div class="col-sm-10">
                        <input type="file" class="form-control-file" name="img" id="img">
                        </div>
                    </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection