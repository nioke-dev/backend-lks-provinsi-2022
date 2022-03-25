<?php

namespace App\Http\Controllers;

use App\Models\Societies;
use App\Models\Vaccinations;
use Illuminate\Http\Request;
use App\Models\Consultations;
use Illuminate\Support\Facades\DB;

class VaccinationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($token)
    {
        $cek_token = Societies::where('login_tokens', $token)->first();

        $get_vaccinations = DB::table('vaccinations')
            ->join('spots', 'spots.id', '=', 'vaccinations.spot_id')
            ->join('regionals', 'spots.regional_id', '=', 'regionals.id')
            ->join('vaccines', 'vaccinations.vaccine_id', '=', 'vaccines.id')
            ->join('medicals', 'vaccinations.doctor_id', '=', 'medicals.id')
            // ->join('medicals', 'vaccinations.officer_id', '=', 'medicals.id')
            ->select(
                'vaccinations.id as queue',
                'vaccinations.dose',
                'vaccinations.date as vaccination_date',
                'spots.id as spot_id',
                'spots.name as spot_name',
                'spots.address as spot_address',
                'spots.serve as spot_serve',
                'spots.capacity as spot_capacity',
                'regionals.id as regional_id',
                'regionals.province as regional_province',
                'regionals.district as regional_district',
                'vaccines.id as vaccines_id',
                'vaccines.name as vaccines_name',
                'medicals.id as medicals_id',
                'medicals.role as medicals_role',
                'medicals.name as medicals_name',
            )
            ->where('society_id', $cek_token->id)
            ->get();

        return response()->json($get_vaccinations);
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
        $cek_token = Societies::where('login_tokens', $token)->first();
        $cek_society_consultation = Consultations::where('society_id', $cek_token->id)->first();


        if (isset($cek_token)) {
            if ($cek_society_consultation->status === 'accepted') {

                $this->validate($request, [
                    'date' => 'date_format:Y/m/d',
                    'spot_id' => 'required'
                ]);

                $cek_vaccinations_table = Vaccinations::where('society_id', $cek_token->id)->get();


                if (count($cek_vaccinations_table) === 2) {
                    return response()->json([
                        'message' => 'Society has been 2x vaccinated'
                    ]);
                } else {
                    if (count($cek_vaccinations_table) === 1) {
                        $diff  = date_diff(date_create($cek_vaccinations_table[0]->date), date_create());
                        if ($diff->days < 30) {
                            return response()->json([
                                'message' => 'Wait at least +30 days from 1st Vaccination'
                            ]);
                        } else {
                            $data = [
                                'dose' => 2,
                                'date' => date('Y-m-d'),
                                'society_id' => $cek_token->id,
                                'spot_id' => $request->input('spot_id'),
                                'vaccine_id' => $request->input('vaccine_id'),
                                'doctor_id' => $request->input('doctor_id'),
                                'office_id' => $request->input('officer_id')
                            ];
                        }
                    }
                    $data = [
                        'dose' => 1,
                        'date' => date('Y-m-d'),
                        'society_id' => $cek_token->id,
                        'spot_id' => $request->input('spot_id'),
                        'vaccine_id' => $request->input('vaccine_id'),
                        'doctor_id' => $request->input('doctor_id'),
                        'officer_id' => $request->input('officer_id')
                    ];


                    $register_vaccination = Vaccinations::create($data);
                    return response()->json($register_vaccination);
                }
            } else {
                return response()->json([
                    'message' => 'Your consultation must be accepted by doctor before'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Unauthorized User!'
            ]);
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
