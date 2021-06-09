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

        $polyline = Http::get('http://localhost/sipenguji-api/api/polyline');
        $polylineResponse = $polyline->json();
        $dataPolyline = $polylineResponse['data'];

        return view('home.index', ['gedung' => $dataGedung, 'polyline' => $dataPolyline]);
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
        $client = Http::post('http://localhost/sipenguji-api/api/gedung', [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jumlah_ruangan' => $request->jumlah_ruangan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
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
        return $response['data'][0];
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
        $client = Http::put('http://localhost/sipenguji-api/api/gedung', [
            'id' => $id,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jumlah_ruangan' => $request->jumlah_ruangan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
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
        $gedung = Http::get('http://localhost/sipenguji-api/api/gedung');
        $response = $gedung->json();
        return $response['data'];
    }
}
