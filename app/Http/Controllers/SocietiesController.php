<?php

namespace App\Http\Controllers;

use App\Models\Societies;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SocietiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $societies = Societies::all();
        return response()->json($societies);
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
     * @param  \App\Models\Societies  $societies
     * @return \Illuminate\Http\Response
     */
    public function show(Societies $societies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Societies  $societies
     * @return \Illuminate\Http\Response
     */
    public function edit(Societies $societies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Societies  $societies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Societies $societies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Societies  $societies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Societies $societies)
    {
        //
    }


    public function login(Request $request)
    {
        $id_card_number = $request->input('id_card_number');
        $password = $request->input('password');

        $societies = Societies::where('id_card_number', $id_card_number)->first();

        if (isset($societies)) {
            if (Hash::check($password, $societies->password)) {

                $token = Str::random(30);

                $societies->update([
                    'login_tokens' => $token
                ]);

                $societies_join = DB::table('societies')
                    ->join('regionals', 'societies.regional_id', '=', 'regionals.id')
                    ->select('societies.*', 'regionals.province', 'regionals.district')
                    ->where('login_tokens', $token)
                    ->first();

                return response()->json(
                    $societies_join
                );
            } else {
                return response()->json([
                    'message' => 'Login Gagal Password Yang Anda Masukkan Salah!!'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Login Gagal Id Card Tidak Ditemukan!!'
            ]);
        }
    }

    public function logout(Request $request, $token)
    {
        $cekTokens = Societies::where('login_tokens', $token)->first();
        if (isset($cekTokens)) {
            return response()->json([
                'message' => 'Logout Success',
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid Token',
            ]);
        }
    }
}
