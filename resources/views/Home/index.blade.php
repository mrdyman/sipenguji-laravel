@extends('layout.main')

@section('title', 'Home')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Content Header (Page header) -->
    <div class="session-success" data-flashsuccess="{{ session('status') }}"></div>
    <div class="session-error" data-flasherror="{{ session('error') }}"></div>
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
                                <a href="#" class="btn btn-tool btn-sm tambah-gedung" data-toggle="modal">
                                    <i class="fas fa-plus-square"></i>
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
                                            {{ $gedung['nama_gedung'] }}
                                        </td>
                                        <td>{{ $gedung['alamat'] }}</td>
                                        <td>{{ $gedung['jumlah_ruangan'] }}</td>
                                        <td>
                                            <a href="#" class="badge badge-warning edit-gedung" id="{{ $gedung['id'] }}" data-toggle="modal">edit</a>
                                            <a href="#" class="badge badge-danger hapus-gedung" id="{{ $gedung['id'] }}">hapus</a>
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
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Data Polyline</h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-sm tambah-polyline" data-toggle="modal">
                                    <i class="fas fa-plus-square"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Titik Awal</th>
                                        <th>Titik Tujuan</th>
                                        <th>Jalur</th>
                                        <th>Koordinat</th>
                                        <th>Jarak</th>
                                        <th>Aksi</th>
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
                                        <td>
                                            <a href="#" class="badge badge-danger hapus-ruangan" id="{{ $p['id'] }}">hapus</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Data Ruangan Ujian</h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-sm tambah-ruangan" data-toggle="modal">
                                    <i class="fas fa-plus-square"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Jenis Ujian</th>
                                        <th>Jumlah Peserta</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ruangan as $ruangan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $ruangan['nama_ruangan'] }}
                                        </td>
                                        <td>{{ $ruangan['jenis_ujian'] }}</td>
                                        <td>
                                            {{ $ruangan['jumlah_peserta'] }}
                                        </td>
                                        <td>
                                            {{ $ruangan['nama_gedung'] }}
                                        </td>
                                        <td>
                                            <a href="#" class="badge badge-warning edit-ruangan" id="{{ $ruangan['id'] }}" data-toggle="modal">edit</a>
                                            <a href="#" class="badge badge-danger hapus-ruangan" id="{{ $ruangan['id'] }}">hapus</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
                <div class="col-lg">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Jadwal Ujian</h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-sm">
                                    <i class="fas fa-plus-square tambah-jadwal" data-toggle="modal"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Ruangan</th>
                                        <th>Nama Gedung</th>
                                        <th>Jadwal</th>
                                        <th>Jumlah Peserta</th>
                                        <th>Sesi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jadwal as $mJadwal)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $mJadwal['nama_ruangan'] }}
                                        </td>
                                        <td>{{ $mJadwal['nama_gedung'] }}</td>
                                        <td>{{ $mJadwal['jadwal'] }}</td>
                                        <td>{{ $mJadwal['jumlah_peserta'] }}</td>
                                        <td>{{ $mJadwal['sesi'] }}</td>
                                        <td>
                                            <a href="#" class="badge badge-warning edit-gedung" id="{{ $gedung['id'] }}" data-toggle="modal">edit</a>
                                            <a href="#" class="badge badge-danger hapus-gedung" id="{{ $gedung['id'] }}">hapus</a>
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
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

        <!-- Modal -->
        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body edit-modal-gedung">
                        <form method="post" action="" enctype=multipart/form-data>
                            @method('put')
                            @csrf
                            <div class="form-group row mb-2">
                                <label for="Nama_modal" class="col-sm-2 col-form-label col-form-label-sm nama-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" id="Nama_modal" placeholder="Nama Gedung" name="nama">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="alamat_modal" class="col-sm-2 col-form-label col-form-label-sm alamat-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" id="alamat_modal" placeholder="Alamat Gedung" name="alamat">
                                </div>
                            </div>

                            <div class="form-group row mb-2 gambar-input">
                                <label for="gambar_modal" class="col-sm-2 col-form-label col-form-label-sm gambar-label">Gambar</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control-file" name="gambar" id="gambar">
                                </div>
                            </div>

                            <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-flat btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-sm btn-flat btn-success btn-update-gedung">Update</button>
                                </div>
                        </form>
                    </div>

                    <div class="modal-body modal-tambah-gedung">
                        <form method="post" action="{{ url ('home') }}" enctype=multipart/form-data>
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
                            <div class="form-group row mb-2 gambar-input">
                                <label for="gambar_modal" class="col-sm-2 col-form-label col-form-label-sm gambar-label">Gambar</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control-file" name="gambar" id="gambar">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-flat btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-flat btn-success btn-simpan-gedung">Simpan</button>
                            </div>
                        </form>
                    </div>

                    <div class="modal-body modal-tambah-ruangan">
                        <form method="post" action="{{ url('ruangan') }}">
                            @csrf
                            <div class="form-group row mb-2">
                                <label for="Nama" class="col-sm-2 col-form-label col-form-label-sm">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" id="nama_ruangan" placeholder="Nama Ruangan" name="nama_ruangan">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="alamat" class="col-sm-2 col-form-label col-form-label-sm">Jenis Ujian</label>
                                <div class="col-sm-10">
                                    <select class="form-control form-control-sm">
                                        <option>SAINTEK</option>
                                        <option>SOSHUM</option>
                                        <option>CAMPURAN</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="alamat" class="col-sm-2 col-form-label col-form-label-sm">Alamat</label>
                                <div class="col-sm-10">
                                    <select name="id_gedung" class="form-control form-control-sm select-ruangan">
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="Nama" class="col-sm-2 col-form-label col-form-label-sm">Latitude</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" id="latitude-ruangan" placeholder="Latitude" name="latitude">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="Nama" class="col-sm-2 col-form-label col-form-label-sm">Longitude</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" id="longitude-ruangan" placeholder="Longitude" name="longitude">
                                </div>
                            </div>

                             <div id="map_ruangan" style="height: 300px;"></div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-flat btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-flat btn-success btn-simpan-ruangan">Simpan</button>
                            </div>
                        </form>
                    </div>

                    <div class="modal-body modal-edit-ruangan">
                        <form method="post" action="{{ url('ruangan') }}">
                            @method('put')
                            @csrf
                            <div class="form-group row mb-2">
                                <label for="Nama" class="col-sm-2 col-form-label col-form-label-sm">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" id="nama_ruangan_edit" placeholder="Nama Ruangan" name="nama_ruangan">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="alamat" class="col-sm-2 col-form-label col-form-label-sm">Jenis Ujian</label>
                                <div class="col-sm-10">
                                    <select class="form-control form-control-sm" name="jenis_ujian">
                                        <option>SAINTEK</option>
                                        <option>SOSHUM</option>
                                        <option>CAMPURAN</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="alamat" class="col-sm-2 col-form-label col-form-label-sm">Alamat</label>
                                <div class="col-sm-10">
                                    <select name="id_gedung" class="form-control form-control-sm select-ruangan-edit">
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="Nama" class="col-sm-2 col-form-label col-form-label-sm">Latitude</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" id="latitude-ruangan-edit" placeholder="Latitude" name="latitude">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="Nama" class="col-sm-2 col-form-label col-form-label-sm">Longitude</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" id="longitude-ruangan-edit" placeholder="Longitude" name="longitude">
                                </div>
                            </div>

                             <div id="map_ruangan_edit" style="height: 300px;"></div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-flat btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-flat btn-success btn-update-ruangan">Update</button>
                            </div>
                        </form>
                    </div>

                    <div class="modal-body modal-tambah-polyline">
                        <form method="post" action="{{ url('polyline') }}">
                            @csrf
                            <div class="form-group row mb-2">
                                <label for="titik_awal" class="col-sm-2 col-form-label col-form-label-sm">Titik Awal</label>
                                <div class="col-sm-10">
                                    <select class="form-control form-control-sm titik_awal">
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="titik_tujuan" class="col-sm-2 col-form-label col-form-label-sm">Titik Tujuan</label>
                                <div class="col-sm-10">
                                    <select class="form-control form-control-sm titik_tujuan">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2">

                                <label for="polyline_koordinat">Koordinat</label>
                                <textarea class="form-control" id="polyline_koordinat"></textarea>
                            </div>

                            <div class="form-group row mb-2">
                                <button type="button" class="btn btn-sm btn-flat btn-danger" id="btn-start">Start</button>
                            </div>

                             <div id="map_polyline" style="height: 300px;"></div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-flat btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection