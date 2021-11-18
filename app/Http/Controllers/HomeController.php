<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gedung = Http::get('http://localhost/sipenguji-api/api/gedung');
        $response = $gedung->json();
        $dataGedung = $response['data'];

        $client = Http::get('http://localhost/sipenguji-api/api/ruangan');
        $result = $client->json();
        $dataRuangan = $result['data'];

        $jadwal = Http::get('http://localhost/sipenguji-api/api/jadwal');
        $dataJadwal = $jadwal->json()['data'];

        return view('home.index', ['gedung' => $dataGedung, 'ruangan' => $dataRuangan, 'jadwal' => $dataJadwal]);
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
        $gambar = $request->file('gambar');

        $client = Http::attach('img', $gambar->get(), $gambar->getClientOriginalName())
            ->post('http://localhost/sipenguji-api/api/gedung', [
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'latitude' => 'this field will deleted soon',
                'longitude' => 'this field will deleted soon'
            ]);

        if ($client->successful()) {
            return redirect('/')->with('status', 'Data berhasil ditambahkan!');
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
        $client = Http::get('http://localhost/sipenguji-api/api/gedung', [
            'id' => $id
        ]);
        $response = $client->json();
        return $response['data'];
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
        $gambar = $request->file('gambar');
        // check file is present and has no problem uploading it
        if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {

            $client = Http::attach('img', $gambar->get(), $gambar->getClientOriginalName())
                ->post('http://localhost/sipenguji-api/api/gedung', [
                    'id' => $id,
                    'nama' => $request->nama,
                    'alamat' => $request->alamat

                ]);
        } else {
            $client = Http::put('http://localhost/sipenguji-api/api/gedung', [
                'id' => $id,
                'nama' => $request->nama,
                'alamat' => $request->alamat
            ]);
        }

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
        $client = Http::asForm()->delete('http://localhost/sipenguji-api/api/gedung', [
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

    public function getMarker()
    {
        $gedung = Http::get('http://localhost/sipenguji-api/api/ruangan');
        $response = $gedung->json();
        return $response['data'];
    }
}
