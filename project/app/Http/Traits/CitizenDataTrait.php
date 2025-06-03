<?php
namespace App\Http\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


trait CitizenDataTrait {
    public function getPersonalInfo(Request $request)
    {
        $role = [
            'id_no' => 'required|numeric|digits:9',
        ];
        $data = $request->validate($role);
        dd(1);
        try {
            $response = Http::timeout(10)->withHeaders([
                'Accept' => 'application/json',
            ])->post('http://10.20.10.126/cmx/index.php/api/Czapi/index_post', [
                'cid' => $data['id_no'],
                'token' => 'fad4fx49kldsjfljre',
            ]);
            $data = $response->json();

            return $data;
        }catch (\Exception $exception){
            return [];
        }

    }



}
