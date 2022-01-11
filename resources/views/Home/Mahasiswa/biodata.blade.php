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
            @if($dataMahasiswa)
            <div class="col-lg-7">
                <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Biodata</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="/mahasiswa" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    <div class="card-body">
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" value="{{ $dataMahasiswa['data']['nama'] }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nisn" class="col-sm-2 col-form-label">NISN</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nisn" name="nisn" placeholder="Nomor Induk Siswa Nasional" value="{{ $dataMahasiswa['data']['nisn'] }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK" value=" {{ $dataMahasiswa['data']['nik'] }} " disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nik" class="col-sm-2 col-form-label">Jurusan</label>
                        <div class="col-sm-10">
                            <select class="custom-select mb-3" name="jurusan" disabled>
                                <option selected>{{ $dataMahasiswa['data']['jurusan'] }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label">Pas Foto</label>
                        <div class="col-sm-10">
                        {{-- <img src="{{ 'http://localhost/sipenguji-api/assets/img/'.$dataMahasiswa['data']['foto'] }}" width="150px" height="190px"> --}}
                        <img src="{{ 'http://mrdyman.com/api/sipenguji/dev/sipenguji-api/assets/img/'.$dataMahasiswa['data']['foto'] }}" width="150px" height="190px">
                        </div>
                    </div>

                    <div class="map" id="map"></div>

                    </div>
                    <!-- /.card-body -->
                </form>
                </div>
            </div>
            @else

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
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nisn" class="col-sm-2 col-form-label">NISN</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" id="nisn" name="nisn" placeholder="Nomor Induk Siswa Nasional" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" id="nik" name="nik" placeholder="NIK" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nik" class="col-sm-2 col-form-label">Jurusan</label>
                        <div class="col-sm-10">
                            <select class="custom-select mb-3" name="jurusan">
                                <option selected>--- Pilih Jurusan ---</option>
                                <option value="D3 - Teknik Sipil">D3 - Teknik Sipil</option>
                                <option value="D3 - Teknik Listrik">D3 - Teknik Listrik</option>
                                <option value="D3 - Teknik Mesin">D3 - Teknik Mesin</option>
                                <option value="D3 - Teknik Bangunan">D3 - Teknik Bangunan</option>
                                <option value="S1 - Teknik Sipil">S1 - Teknik Sipil</option>
                                <option value="S1 - Teknik Geologi">S1 - Teknik Geologi</option>
                                <option value="S1 - Teknik Arsitektur">S1 - Teknik Arsitektur</option>
                                <option value="S1 - Teknik Perencanaan Wilayah Kota">S1 - Teknik Perencanaan Wilayah Kota</option>
                                <option value="S1 - Teknik Informatika">S1 - Teknik Informatika</option>
                                <option value="S1 - Teknik Elektro">S1 - Teknik Elektro</option>
                                <option value="S1 - Sistem Informasi">S1 - Sistem Informasi</option>
                                <option value="S1 - Fisika">S1 - Fisika</option>
                                <option value="S1 - Kimia">S1 - Kimia</option>
                                <option value="S1 - Biologi">S1 - Biologi</option>
                                <option value="S1 - Farmasi">S1 - Farmasi</option>
                                <option value="S1 - Statistika">S1 - Statistika</option>
                                <option value="S1 - Kehutanan">S1 - Kehutanan</option>
                                <option value="S1 - Kedokteran">S1 - Kedokteran</option>
                                <option value="S1 - Kesehatan Masyarakat">S1 - Kesehatan Masyarakat</option>
                                <option value="S1 - Ekonomi Pembangunan">S1 - Ekonomi Pembangunan</option>
                                <option value="S1 - Akuntasi">S1 - Akuntasi</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label">Pas Foto</label>
                        <div class="col-sm-10">
                        <input type="file" class="form-control-file" name="img" id="img" required>
                        </div>
                    </div>

                    <div class="map" id="map"></div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
                </div>
            </div>
            @endif
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection