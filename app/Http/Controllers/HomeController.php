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
        $gedung = Http::get('http://localhost/sipenguji-api/api/ruangan');
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
        $client = Http::post('http://localhost/sipenguji-api/api/ruangan', [
            'nama' => $request->nama,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);
        if ($client->successful()) {
            return redirect('home')->with('status', 'Data berhasil ditambahkan!');
        } else {
            $errorCode = $client->status();
            return redirect('home')->with('status', 'Terdapat kesalahan! ' . $errorCode);
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
        //
    }
}
