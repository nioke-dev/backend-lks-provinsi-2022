<?php

namespace App\Http\Controllers;

use App\Models\Consultations;
use App\Models\Societies;
use Illuminate\Http\Request;

class ConsultationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($token)
    {
        $societes_cek = Societies::where('login_tokens', $token)->first();
        if (isset($societes_cek)) {
            $consultation_get = Consultations::where('society_id', $societes_cek->id)->first();
            if (isset($consultation_get)) {

                return response()->json($consultation_get);
            } else {
                return response()->json([
                    'message' => 'Societies never consult'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Unauthorized User'
            ]);
        }
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
    public function store(Request $request, $token)
    {
        $societes_cek = Societies::where('login_tokens', $token)->first();

        if (isset($societes_cek)) {
            $data = [
                'society_id' => $societes_cek->id,
                'doctor_id' => mt_rand(1, 10),
                'status' => 'pending',
                'desease_history' => $request->input('desease_history'),
                'current_symptomps' => $request->input('current_symptomps'),
                'doctor_notes' => 'Belum Dibaca'
            ];

            $consultations = Consultations::create($data);

            if ($consultations) {
                return response()->json([
                    'message' => 'Request Consultaion Sent Successful'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Unauthorized User'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consultations  $consultations
     * @return \Illuminate\Http\Response
     */
    public function show(Consultations $consultations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consultations  $consultations
     * @return \Illuminate\Http\Response
     */
    public function edit(Consultations $consultations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consultations  $consultations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consultations $consultations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consultations  $consultations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consultations $consultations)
    {
        //
    }
}
