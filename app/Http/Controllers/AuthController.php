<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Session::get('user');
        if ($user) {
            if ($user['role'] == 0) {
                return redirect('/');
            } else {
                return redirect('mahasiswa');
            }
        }
        return view('auth.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.registration');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = Http::post('http://localhost/sipenguji-api/api/user/register', [
            'username' => $request->username,
            'password' => $request->password,
            'role' => 1
        ]);

        if ($client->successful()) {
            return redirect('/auth')->with('success', 'Registrasi akun berhasil!');
        } else {
            $errorCode = $client->status();
            return redirect('/auth/registration')->with('error', 'Terdapat kesalahan! Error Code:' . $errorCode);
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

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $client = Http::post('http://localhost/sipenguji-api/api/user/login', [
            'username' => $request->username,
            'password' => $request->password
        ]);

        if ($client->successful()) {
            //create session
            $dataUser = $client->json(['data']);
            Session::put('user', $dataUser);

            if ($dataUser['role'] == 0) {
                return redirect('/home')->with('status', 'welcome!');
            } else {
                return redirect('mahasiswa')->with('status', 'welcome!');
            }
        } else {
            $errorCode = $client->status();
            return redirect('/auth')->with('errorLogin', $client->json(['message']));
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/auth');
    }
}
