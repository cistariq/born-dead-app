<?php
namespace App\Http\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\DEADS_TB;

//
trait DeadDataTrait {
    public function check_records(Request $request)
    {
        $role = [
            'P_ID_NO' => 'required|numeric|digits:9',
        ];
       // dd($request->P_ID_NO);
        $data = $request->validate($role);

        try {
            $response = Http::timeout(10)->withHeaders([
                'Accept' => 'application/json',
              ])->post('http://5.75.180.175/moh-registration/public/api/check_records_details', [
           // ])->post('http://5.75.180.175/moh-registration/public/api/check_records', [
                'MA_ID' => $data['P_ID_NO'],
                'token' => 'fad4fx49kldsjfljrefx49',
            ]);

            $data = $response->json();
           // dd($data);

if($data['exist']==1 && $data['status_cd'] != 1){

  if($data['hosp_cd'] != null){
     $hos_data= DEADS_TB::GET_HOS_DREF($response->json()['hosp_cd']);
     $data['dref_cd'] = $hos_data[0]['DREF_CODE'];

     }
    }
     //dd($data);
            return $data;
        }catch (\Exception $exception){
            return [];
        }

    }



}
