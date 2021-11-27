<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PolylineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polyline = Http::get('http://localhost/sipenguji-api/api/polyline');
        $dataPolyline = $polyline->json()['data'];
        return view('home.polyline.index', ['polyline' => $dataPolyline]);
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
        $client = Http::post('http://localhost/sipenguji-api/api/polyline', [
            'titik_awal' => $request->tAwal,
            'titik_tujuan' => $request->tTujuan,
            'jalur' => $request->jalur,
            'koordinat' => $request->koordinat,
            'jarak' => $request->jarak
        ]);

        if ($client->successful()) {
            echo json_encode("Data polyline berhasil ditambahkan!");
        } else {
            echo json_encode($client->status());
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
        $client = Http::asForm()->delete('http://localhost/sipenguji-api/api/polyline', [
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
        $ruangan = Http::get('http://localhost/sipenguji-api/api/ruangan');
        $response = $ruangan->json();
        return $response['data'];
    }

    public function displayPolyline()
    {
        $client = Http::get('http://localhost/sipenguji-api/api/polyline/display');

        if ($client->successful()) {
            return $response = $client->json(['data']);
        } else {
            echo 'Failed connect to API';
        }
    }
}
