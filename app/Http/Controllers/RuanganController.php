<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $client = Http::post('http://localhost/sipenguji-api/api/ruangan', [
            'nama_ruangan' => $request->nama_ruangan,
            'jumlah_peserta' => 'will change to auto fill by count mahasiswa',
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'id_gedung' => $request->id_gedung,
        ]);

        if ($client->successful()) {
            return redirect('/')->with('status', 'Data Ruangan berhasil ditambahkan!');
        } else {
            $errorCode = $client->status();
            return redirect('/')->with('error', 'Terdapat kesalahan! Error Code:' . $errorCode);
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
        $client = Http::get('http://localhost/sipenguji-api/api/ruangan', [
            'id' => $id
        ]);
        if ($client->successful()) {
            if ($client->json(['status'])) {
                $response = $client->json();
                return $response['data'][0];
            }
        }
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
        $client = Http::put('http://localhost/sipenguji-api/api/ruangan', [
            'id' => $id,
            'nama_ruangan' => $request->nama_ruangan,
            'jenis_ujian' => $request->jenis_ujian, //'this field will be moved to jadwal table'
            'jumlah_peserta' => 'this field will be auto fill by count mahasiswa',
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'id_gedung' => $request->id_gedung
        ]);

        if ($client->successful()) {
            $message = $client->json(['message']);
            return redirect('/')->with('status', $message);
        } else {
            $errorCode = $client->status();
            return redirect('/')->with('error', 'something wrong! with code: ' . $errorCode);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Http::asForm()->delete('http://localhost/sipenguji-api/api/ruangan', [
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
}
