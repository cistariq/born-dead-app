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
                'Token' => 'JHyUyQOgG_lmclH7qOQHL4wddkN050M63B_qqbs0r0QgvHbI3lmB6cp2zdU_HvUzdhdysYsVLiSPBiCgIBw4cGxOb4_H-A1bPCUyYeMcV5r_isM7lyblL0ZYV3jcQVsPalY1hUVD0tZuXJfNm8QEeVEg2g4-6SlSI73IKvrO1AxzVoQ9lLDy-FylPB-xq30KoEhoI6B4ull1UD-xokcVZHYJ0oCkgyQHRSzT15VyJgYl8VsIkaeex5BivybOj6YjO59m2UIn53GO1tzYpw26KaWC23CkCRwF8hF-dzL7Gb1cFzSX-Wgx8A9u1KFegNhQXRj4vlzBkvUcU8GGn8wBTJKEXHRc-tw2qy6avXJr5dxrBW4o1XFTyg2pPJdXChYG-cPaz4YonCA1OICWi9Ht91imarRN0BCgd55BuLjrcjVhxM0AsQe3iur6s_EN_XtpZa-Xq3TndxMqnaJuvIZBLg',
            ]);
            $data = $response->json();
 //dd($data);
            return $data;
        }catch (\Exception $exception){
            return [];
        }

    }



}
