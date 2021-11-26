<!-- Begin Page Content -->
<div class="container-fluid">
    <html>
        <head>
            <title>Cetak Kartu Peserta</title>
        </head>
        <body>
            <div class="" style="border-style: solid; padding: 5px">
                <table class="basic" cellspacing="1" cellpadding="2" width="100%">
                    <tbody>
                        <tr>
                            <td align="center">
                                <img src="..\assets\img\logo.png" width="75" height="75" align="left">
                                <font size="+1"><b>KEMENTERIAN PENDIDIKAN, KEBUDYAAN, RISET, DAN TEKNOLOGI</b></font><br>
                                <font size="+2"><b>UNIVERSITAS TADULAKO</b></font><br>
                                <font size="+1">KAMPUS BUMI TADULAKO</font><br>
                                <font size="+1">Jl. Seokarno Hatta Km. 9 Telp : (0451) 422611-422355 Fax : (0451) 422844</font><br>
                                <font size="+1" style="color: blue"><u>Email : untad@untad.ac.id</u></font>
                                <hr size="1">
                            </td>
                        </tr>
                    </tbody>
                </table>
        
                <table class="basic" cellspacing="1" cellpadding="2" width="100%" border="1" style="border-collapse: collapse">
                    <tbody>
                        <tr>
                            <td align="left">
                                <font size="4"><b> JADWAL UJIAN  </b></font>
                            </td>
                            <td align="left">
                                <font size="4"><b> {{ $data['jadwal'] }}  </b></font>
                            </td>
                        </tr>
                        <tr>
                            <td align="left">
                                <font size=4"><b> KELOMPOK UJIAN  </b></font>
                            </td>
                            <td align="left">
                                <font size="4"><b> {{ $data['jenis_ujian'] }}  </b></font>
                            </td>
                        </tr>
                        <tr>
                            <td align="left">
                                <font size="4"><b> LOKASI UJIAN  </b></font>
                            </td>
                            <td align="left">
                                <font size="4"><b> {{ $data['nama_ruangan'] }}  </b></font>
                            </td>
                        </tr>
                    </tbody>
                </table> <br>
                <div style="border-style: solid; padding: 5px">
                    <table class="basic" cellspacing="1" cellpadding="2" width="100%" border="1" style="border-collapse: collapse">
                        <tbody>
                            <tr>
                                <td align="left">
                                    <font size="4"><b> NOMOR PESERTA  </b></font>
                                </td>
                                <td align="left">
                                    <font size="4"><b> {{ $data['nomor_peserta'] }}  </b></font>
                                </td>
                                <td align="center" rowspan="4">
                                    <img src="{{ ('http://localhost/sipenguji-api/assets/img/'. $data['foto']) }}" width="150px" height="200px;">
                                </td>
                                <td align="center" rowspan="4">
                                    {!! QrCode::size(150)->generate($data['nisn']); !!}
                                </td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <font size=4"><b> NAMA PESERTA  </b></font>
                                </td>
                                <td align="left">
                                    <font size="4"><b> {{ $data['nama'] }}  </b></font>
                                </td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <font size="4"><b> NIK PESERTA  </b></font>
                                </td>
                                <td align="left">
                                    <font size="4"><b> {{ $data['nik'] }}  </b></font>
                                </td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <font size="4"><b> PILIHAN JURUSAN  </b></font>
                                </td>
                                <td align="left">
                                    <font size="4"><b> {{ $data['jurusan'] }}  </b></font>
                                </td>
                            </tr>
                        </tbody>
                    </table> <br>
                </div><br>

                <div style="border-style: solid; padding: 5px">
                    <p><b>CATATAN : </b></p><br>
                    <p>1. Membawa Ijazah Asli/Fotocopy (Legalisir) untuk lulusan 2019 dan 2020 atau SKHU (Surat Keterangan Hasil Ujian) untuk lulusan 2021</p>
                    <p>2. Wajib menggunakan masker</p>
                    <p>3. Wajib membawa kartu peserta ujian dan dihimbau membawa identitas pendukung lainnta (KTP/SIM)</p>
                    <p>4. Peserta membawa pensil 2B, Karet penghapus, peraut pensil</p>
                </div>
            </div>
        </body>

    </html>
</div>
<!-- /.container-fluid -->

<script>
    window.print();
</script>