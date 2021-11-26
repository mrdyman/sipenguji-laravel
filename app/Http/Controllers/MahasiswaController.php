<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $username = Session::get('user')['username'];
        $dataMahasiswa = Http::get('http://localhost/sipenguji-api/api/mahasiswa', [
            'username' => $username
        ]);
        if ($dataMahasiswa->successful()) {
            if ($dataMahasiswa->json()['status'] == false) {
                $dataMahasiswa = null;
            }
        } else {
            dd($dataMahasiswa->json());
        }
        return view('home.mahasiswa.biodata', ['dataMahasiswa' => $dataMahasiswa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gambar = $request->file('img');
        $username = Session::get('user')['username'];

        $client = Http::attach('img', $gambar->get(), $gambar->getClientOriginalName())
            ->post('http://localhost/sipenguji-api/api/mahasiswa', [
                'nisn' => $request->nisn,
                'nik' => $request->nik,
                'nama' => $request->nama,
                'jurusan' => $request->jurusan,
                'username' => $username
            ]);

        if ($client->successful()) {
            return redirect('/mahasiswa')->with('status', 'Data berhasil disimpan!');
        } else {
            $errorCode = $client->status();
            return redirect('/mahasiswa')->with('error', 'Terdapat kesalahan! Error Code:' . $errorCode);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Http::asForm()->delete('http://localhost/sipenguji-api/api/mahasiswa', [
            'id' => $id
        ]);
        if ($client->successful()) {
            if ($client->json(['status'])) {
                return redirect('/');
            }
        } else {
            return $client->json();
        }
    }

    public function cetak()
    {
        $username = Session::get('user')['username'];
        $dataMahasiswa = Http::get('http://localhost/sipenguji-api/api/mahasiswa', [
            'username' => $username
        ]);
        if ($dataMahasiswa->successful()) {
            if ($dataMahasiswa->json()['status'] == false) {
                $dataMahasiswa = null;
            }
        } else {
            dd($dataMahasiswa->json());
        }
        return view('home.mahasiswa.cetak', ['dataMahasiswa' => $dataMahasiswa]);
    }

    public function bayar()
    {
        $username = Session::get('user')['username'];
        $payment = Http::put('http://localhost/sipenguji-api/api/payment', [
            'username' => $username,
            'status_bayar' => 1
        ]);
        if ($payment->successful()) {
            return redirect('/mahasiswa/cetak')->with('status', 'Pembayaran Sukses!');;
        } else {
            dd($payment->json());
        }
    }

    public function downloadKartu()
    {
        //cetak kartu peserta ujian
    }
}
