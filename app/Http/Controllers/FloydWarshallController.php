<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Config;

class FloydWarshallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost/sipenguji-api/api/floyd');
        // $response = Http::get(config('api_config.api_base_url') . 'floyd');
        $hasil = $response->json()['data'];
        return view('home.floyd-warshall.index', ['hasil_floyd' => $hasil]);
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
        //
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
        $client = Http::asForm()->delete('http://localhost/sipenguji-api/api/floyd', [
            // $client = Http::asForm()->delete(config('api_config.api_base_url') . 'floyd', [
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

    /**
     * Calculate shortest Path.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function calculate(Request $request)
    {
        $response = Http::post('http://localhost/sipenguji-api/api/floyd', [
            // $response = Http::post(config('api_config.api_base_url') . 'floyd', [
            'titik_awal' => $request->source,
            'titik_tujuan' => $request->destination,
        ]);

        if ($response->successful()) {
            return $response->json();
        } else {
            dd($response->status());
        }
    }

    public function hasil()
    {
        $hasil = Http::get('http://localhost/sipenguji-api/api/floyd/hasil');
        // $hasil = Http::get(config('api_config.api_base_url') . 'floyd/hasil');
        if ($hasil->successful()) {
            return $hasil->json();
        } else {
            return $hasil->status();
        }
    }
}
