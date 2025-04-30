<?php
namespace App\Http\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
//
trait BornDataTrait {
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
 //dd($data);
            return $data;
        }catch (\Exception $exception){
            return [];
        }

    }

    public function getTokenCommitment(Request $request)
    {
        $response= Http::asForm()->post('https://gapi.ctznps.com/api/Security/Login', [
            'UserName'=> '112222244',
            'Password'=>'f8KgNRm4qErT#*C'
        ]);
        //dd(trim($response->json()['Data']['Token']));
        if(isset($response->json()['Data']['Token']))
        {
            return $response->json()['Data']['Token'];
        }else{
            return '1';}


}

}
