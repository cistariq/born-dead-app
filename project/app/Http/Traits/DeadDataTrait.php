<?php
namespace App\Http\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
                      //  ])->post('http://5.75.180.175/moh-registration/public/api/check_records_details', [
            ])->post('http://5.75.180.175/moh-registration/public/api/check_records', [
                'MA_ID' => $data['P_ID_NO'],
                'token' => 'fad4fx49kldsjfljrefx49',
            ]);
            $data = $response->json();
 //dd($data);
            return $data;
        }catch (\Exception $exception){
            return [];
        }

    }



}
