<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\C_REGION_TB;
use App\Models\BORNS_INFO_TB;
//
trait BornDataTrait
{
    public function check_record_born(Request $request)
    {
        $role = [
            'P_BI_ID' => 'required|numeric|digits:9',
        ];
        // dd($request->P_BI_ID);
        $data = $request->validate($role);
        $token = $this->getTokenCommitment($request);
        try {
            $response = Http::timeout(10)->withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,

            ])->post('https://gapi.ctznps.com/api/Moh/GetBirthForms', [
                'IdNumber' => $data['P_BI_ID'],
            ]);
            $data = $response->json();
            //   dd($data['Data']['REGION']);
            $region_data = BORNS_INFO_TB::GET_BORN_REGION($data['Data']['REGION']);
            $city_data = BORNS_INFO_TB::GET_BORN_CITY($data['Data']['CITY']);
            $born_status = BORNS_INFO_TB::GET_BORN_STATUS($data['Data']['BIRTH_STATUS']);
            $hos_data = BORNS_INFO_TB::GET_HOS_DREF($data['Data']['BIRTH_HOSPITAL']);

            if ($region_data != null) {
                $data['Data']['region_cd'] = $region_data[0]['R_CODE'];
            }
            if ($city_data != null) {
                $data['Data']['city_cd'] = $city_data[0]['C_CODE'];
            }
            if ($born_status != null) {
                $data['Data']['delivery_cd'] = $born_status[0]['DELIVERY_CODE'];
            }


            if ($hos_data != null) {
                $data['Data']['dref_cd'] = $hos_data[0]['DREF_CODE'];
            }




            //dd($data['region_cd']);
            return $data;
        } catch (\Exception $exception) {
            return [];
        }
    }

    public function getTokenCommitment(Request $request)
    {
        $response = Http::asForm()->post('https://gapi.ctznps.com/api/Security/Login', [
            'UserName' => '112222244',
            'Password' => 'f8KgNRm4qErT#*C'
        ]);
        //dd(trim($response->json()['Data']['Token']));
        if (isset($response->json()['Data']['Token'])) {
            return $response->json()['Data']['Token'];
        } else {
            return '1';
        }
    }
}
