<?php
namespace App\Http\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
//
trait BornDataTrait {
    public function check_born_records(Request $request)
    {
        $role = [
            'P_BI_ID' => 'required|numeric|digits:9',
        ];
       // dd($request->P_BI_ID);
        $data = $request->validate($role);

        try {
            $response = Http::timeout(10)->withHeaders([
                'Accept' => 'application/json',
            ])->post('https://gapi.ctznps.com/api/Moh/GetBirthForms', [
                'IdNumber' => $data['P_BI_ID'],
                'token' => 'qAvyNSHiDkOhvT3-TgEh9FafruRrYWWhu94140lbxKpp7jZ50HIe9djEpDhcHqgsmFwRKDjMZVikzmcSGZdPB9a-dCCOmBvjR07RFeXQJo4Wjv2TPbuGM81So0cWNrafBDdx5UBHA9ZZlEEcyQeaNfy1QZiTbPsjfwi8MlP1yVMiGQY99dYT8x1rvgQ7V3teJhBDDHc6xIchN4YfWI2f9kWp6laO8T2OOt2FOtGN57K8SxC2W1n_LwInrwBU_CvZLtSfzaFrNe7WtbDOkrDD4iGkdXev---KwF4hqB2RyzacEcbBXj0vTp-MNYs4Mg9YdGR5EJQuXaPtzQdrjKtrL5bcpYiyVNTE1-3ArR2PtHrTcEzOic-Cm-rcYGfK1FfofWonMm20nLZXi6KCxSVNZ6zf3NdZxB-Aub3OyNjU7UxwYYqyBDU02fsiy9QIx5qr47TtY0u_o5W3XUgZXvh4ng',
            ]);
            $data = $response->json();
 //dd($data);
            return $data;
        }catch (\Exception $exception){
            return [];
        }

    }



}
