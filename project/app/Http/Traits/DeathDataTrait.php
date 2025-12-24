<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\DEADS_TB;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


trait DeathDataTrait
{
    public function check_record_death(Request $request)
    {
        $role = [
            'P_ID_NO' => 'required|numeric|digits:9',
        ];
        // dd($request->P_ID_NO);
        $data = $request->validate($role);
        $token = $this->getTokenCommitment_D($request);
        try {
            $response = Http::timeout(10)->withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,

            ])->post('https://gapi.ctznps.com/api/Moh/GetCtznDead', [
                'IdNumber' => $data['P_ID_NO'],
            ]);
            $data = $response->json();

            if ($data['Data'][0]['GenderCD'] != null) {

                $gender_data = DB::table('C_SEX_TB')->where('SEX_MOI_CODE', $data['Data'][0]['GenderCD'])->first();
                if ($gender_data != null) {

                    $data['Data'][0]['sex_cd'] = $gender_data->sex_code;
                }
            }
            if ($data['Data'][0]['PersonalCD'] != null) {

                $personal_data = DB::table('C_MARTIAL_STATUS_TB')->where('MS_MOI_CODE', $data['Data'][0]['PersonalCD'])->first();
                if ($personal_data != null) {

                    $data['Data'][0]['personal_cd'] = $personal_data->ms_code;
                }
            }
            if ($data['Data'][0]['RegionCD'] != null) {

                $region_data = DB::table('C_REGION_TB')->where('R_MOI_CODE', $data['Data'][0]['RegionCD'])->first();
                if ($region_data != null) {

                    $data['Data'][0]['REGION_CD'] = $region_data->r_code;
                }
            }

            if ($data['Data'][0]['BIRTH_CITY_CD'] != null) {

                $city_data = DB::table('C_CITY_TB')->where('C_CITY_MOI_CD', $data['Data'][0]['BIRTH_CITY_CD'])->first();

                if ($city_data != null) {

                    $data['Data'][0]['CITY_CD'] = $city_data->c_code;
                }
            }



            return $data;
        } catch (\Exception $exception) {
            return [];
        }
    }

    public function getTokenCommitment_D(Request $request)
    {
        $response = Http::asForm()->post('https://gapi.ctznps.com/api/Security/Login', [
            'UserName' => '882222277',
            'Password' => 'Fd56*MVZ#403'
        ]);
        //dd(trim($response->json()['Data']['Token']));
        if (isset($response->json()['Data']['Token'])) {
            return $response->json()['Data']['Token'];
        } else {
            return '1';
        }
    }
}
