<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


trait SendSmsTrait
{
    public function Send_SMS(Request $request)
    {
        $role = [
            'P_advertiser_Phone' => 'required|numeric|digits:10',
            'QR_CODE' => 'required|numeric',
            'P_ID' => 'required|numeric',
        ];
        //dd($request->all());
        $data = $request->validate($role);
        $token = $this->getTokenCommitment($request);

        try {
            $response = Http::timeout(10)->withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,

            ])->post('https://sehatty.ps/public/api/send_sms', [
                'mobile' => $data['P_advertiser_Phone'],
                'text'=>'كود الاستعلام :'. $data['QR_CODE'].'المتوفي: '.$data['P_ID'] . 'رابط الاستعلام : https://sehatty.ps/public/check_dead_data',
            ]);
            $data = $response->json();

            return $data;
        } catch (\Exception $exception) {
            return [];
        }
    }

    public function getTokenCommitment(Request $request)
    {
        $response = Http::asForm()->post('https://sehatty.ps/public/api/loginUser', [
            'userid' => '233036',
            'password' => 'P@ssw0rd20242025',
        ]);
        if (isset($response->json()['token'])) {
            return $response->json()['token'];
        } else {
            return null;
        }
    }
}
