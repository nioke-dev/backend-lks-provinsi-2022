<?php

namespace App\Http\Controllers;

use App\Models\Spots;
use App\Models\Vaccines;
use App\Models\Societies;
use Nette\Utils\DateTime;
use App\Models\Vaccinations;
use Illuminate\Http\Request;
use App\Models\Status_vaccine;
use Illuminate\Support\Facades\DB;


class SpotsController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spots  $spots
     * @return \Illuminate\Http\Response
     */
    public function show(Spots $spots)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spots  $spots
     * @return \Illuminate\Http\Response
     */
    public function edit(Spots $spots)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spots  $spots
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spots $spots)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spots  $spots
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spots $spots)
    {
        //
    }

    public function getbytoken($token)
    {
        $data_societies = Societies::where('login_tokens', $token)->first();

        if (isset($data_societies)) {

            // $spot_vaccines = DB::table('spot_vaccines')
            //     ->join('spots', 'spot_vaccines.vaccine_id', '=', 'spots.id')
            //     ->join('status_vaccine', 'status_vaccine.spot_id', '=', 'spot_vaccines.spot_id')
            //     ->select('status_vaccine.*')
            //     ->where('spot_vaccines.spot_id', 'status_vaccine.spot_id')
            //     ->get();


            $spot = DB::table('spots')
                ->join('status_vaccine', 'status_vaccine.spot_id', '=', 'spots.id')
                ->select('spots.id', 'spots.name', 'spots.address', 'spots.serve', 'spots.capacity', 'status_vaccine.sinovac', 'status_vaccine.AstraZeneca', 'status_vaccine.Moderna', 'status_vaccine.Pfizer', 'status_vaccine.Sinnopharm',)
                ->where('spots.regional_id', $data_societies->regional_id)
                ->get();

            // $spot = Spots::all();

            // $spot_new = Spots::where('regional_id', $data_societies->regional_id)->select('spots.*', )->get();

            $status_vaccine = Status_vaccine::where('spot_id', $spot[0]->id);

            return response()->json($spot);
        } else {
            return response()->json([
                'message' => 'user unauthorized'
            ]);
        }
        // $cek_status_vaksin = DB::table('vaccines')
        //     ->join('status_vaccine', 'status_vaccine.vaccine_id', '=', 'vaccines.id')
        //     // ->join('spot_vaccines', 'spot_vaccines.vaccine_id', '=', 'vaccines.id')
        //     ->select('vaccines.name', 'status_vaccine.status')
        //     ->get();
    }

    public function getspotdetail(Request $request, $token, $date, $id_spot)
    {
        // $diff  = date_diff(date_create($request->input('date')), date_create());
        // return response()->json($diff->days);
        // echo $diff->format('Sudah %a hari Sejak Anda Vaksin Dosis Pertama');
        // $tgl1 = new DateTime($request->input('date'));
        // $tgl2 = new DateTime(now());
        // $d = $tgl2->diff($tgl1)->days + 1;
        // echo $d . " hari";

        $cek_token = Societies::where('login_tokens', $token)->first();

        if (isset($cek_token)) {
            $get_spots = Spots::where('id', $id_spot)->first();

            $get_vaccinations = Vaccinations::where('date', $date)->get();

            return response()->json([
                'date' => $date,
                'spot' => $get_spots,
                'vaccinations_count' => count($get_vaccinations),
            ]);
        } else {
            return response()->json([
                'message' => 'Unauothorized User'
            ]);
        }
    }
}
