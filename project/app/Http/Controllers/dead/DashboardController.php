<?php

namespace App\Http\Controllers\dead;
use App\Http\Controllers\Controller;
use App\Models\DEADS_TB;
use App\Models\BORNS_INFO_TB;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $data['DeadCount'] = DEADS_TB::count();
        $data['BornCount'] = BORNS_INFO_TB::count();

        $data['DeadCount_M'] = DEADS_TB::where('DEAD_SEX_CD',1)->count();
        $data['DeadCount_F'] = DEADS_TB::where('DEAD_SEX_CD',2)->count();
        $data['BornCount_M'] = BORNS_INFO_TB::where('BI_SEX_CD',1)->count();
        $data['BornCount_F'] = BORNS_INFO_TB::where('BI_SEX_CD',2)->count();

        $Deads = DEADS_TB::GET_COUNT_DEAD();

        $chart_data = [];
        $region_data = [];
        foreach ($Deads as $Dead) {
        $chart_data[] = [
            'name' => $Dead['NAME'],
            'total' => $Dead['TOTAL'],
        ];
        }

         $Regions = DB::table('DEADS_TB')
         ->join('C_REGION_TB', 'C_REGION_TB.R_CODE', '=', 'DEADS_TB.DEAD_REGION_CD')
         ->select('C_REGION_TB.R_NAME_AR  as name',  DB::raw('COUNT(*) AS total'))
         ->having(DB::raw('COUNT(*)'), '>', 100)

         ->groupBy('C_REGION_TB.R_NAME_AR')
         ->get();


         $Born_City =BORNS_INFO_TB::GET_COUNT_BORN();

         foreach ($Born_City as $city) {
            $city_data[] = [
                'name_city2' => $city['NAME'],
                'total_city2' => $city['TOTAL'],
            ];
         }



     //   dd($Martyr);

         foreach ($Regions as $Region) {
            $region_data[] = [
                'name_city' => $Region->name,
                'total_city' => $Region->total,
            ];
         }

         $data['chart_data'] = $chart_data;
         $data['region_data'] = $region_data;
         $data['city_data'] = $city_data;
        //dd($data);
        return view('dashboard',$data);
    }

}
