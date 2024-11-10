<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\CitizenDataTrait;
use App\Models\Citizen;
use App\Models\CitizenData;
use App\Models\DEADS_TB;
use App\Models\BORNS_INFO_TB;
use App\Models\C_DETAILS_REFERRAL_TB;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Exports\DeadExport;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\LaravelPdf\Facades\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        return view('Report.Distribution_form_D');
    }
    public function Icd_Search()
    {
        return view('Report.Icd_Search');
    }

    public function Distribution_Death_Place(Request $request)
    {
        // ini_set('max_execution_time', -1);
        // ini_set('memory_limit',-1);

        $query = DEADS_TB::GET_DEADS_DEATH_PLACE($request->all());
     // dd($query);
        $data1['user_id'] = Auth()->id();
        $data1['ip'] = request()->ip();
        $data1['id_no'] = Auth()->id();
        $data1['table_name'] = 'DEADS_TB';
        $data1['column_name'] = ' ';
       // $data1['old_record'] = $request->all();
        $data1['type_action'] = 'DL';
        Log::create($data1);
 //  dd(Auth());
        $result['data']=$query;

        $result['old_record'] = $request->all();
        $result['user_name'] = Auth()->user()->name;
        // dd($result['old_record']);
        // $respdf= Pdf::view('Report.Distribution_Death_Place', $result)
        // ->format('a4')
        // ->name('Distribution_Death_Place.pdf');
        // return $respdf;

       return view('Report.Distribution_Death_Place',$result);

    }
//----------------------------------------------------------------------------
    public function Distribution_Region_Ages(Request $request)
    {
        $result['old_record'] = $request->all();
        $result['user_name'] = Auth()->user()->name;

        $data1['user_id'] = Auth()->id();
        $data1['ip'] = request()->ip();
        $data1['id_no'] = Auth()->id();
        $data1['table_name'] = 'DEADS_TB';
        $data1['column_name'] = ' ';
       // $data1['old_record'] = $request->all();
        $data1['type_action'] = 'DL';
        Log::create($data1);
 //  dd(Auth());
 $request->merge([
    'Age_From' => 0,
    'Age_To' => 1,
]);
$query = DEADS_TB::GET_DEADS_REGION($request->all());
$result['data4']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());

        $result['data']=$query;
        $request->merge([
            'Age_From' => 10,
            'Age_To' => 15,
        ]);
        $result['data1']=DEADS_TB::GET_DEADS_REGION($request->all());
        $result['data45']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());

        $request->merge([
            'Age_From' => 5,
            'Age_To' => 10,
        ]);
        $result['data2']=DEADS_TB::GET_DEADS_REGION($request->all());
        $result['data44']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());

        $request->merge([
            'Age_From' => 1,
            'Age_To' => 5,
        ]);
        $result['data3']=DEADS_TB::GET_DEADS_REGION($request->all());
        $result['data43']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());


        $request->merge([
            'Age_From' => 30,
            'Age_To' => 35,
        ]);
        $result['data5']=DEADS_TB::GET_DEADS_REGION($request->all());
        $result['data42']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());


        $request->merge([
            'Age_From' => 25,
            'Age_To' => 30,
        ]);
        $result['data6']=DEADS_TB::GET_DEADS_REGION($request->all());
        $result['data41']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());

        $request->merge([
            'Age_From' => 20,
            'Age_To' => 25,
        ]);
        $result['data7']=DEADS_TB::GET_DEADS_REGION($request->all());
        $result['data40']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());

        $request->merge([
            'Age_From' => 15,
            'Age_To' => 20,
        ]);
        $result['data8']=DEADS_TB::GET_DEADS_REGION($request->all());
        $result['data9']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());


        $request->merge([
            'Age_From' => 50,
            'Age_To' => 55,
        ]);
        $result['data10']=DEADS_TB::GET_DEADS_REGION($request->all());
        $result['data39']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());


        $request->merge([
            'Age_From' => 45,
            'Age_To' => 50,
        ]);
        $result['data11']=DEADS_TB::GET_DEADS_REGION($request->all());
        $result['data38']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());


        $request->merge([
            'Age_From' => 40,
            'Age_To' => 45,
        ]);
        $result['data12']=DEADS_TB::GET_DEADS_REGION($request->all());
        $result['data37']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());


        $request->merge([
            'Age_From' => 35,
            'Age_To' => 40,
        ]);
        $result['data13']=DEADS_TB::GET_DEADS_REGION($request->all());
        $result['data14']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());

        $request->merge([
            'Age_From' => 70,
            'Age_To' => 75,
        ]);
        $result['data15']=DEADS_TB::GET_DEADS_REGION($request->all());
        $result['data36']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());


        $request->merge([
            'Age_From' => 65,
            'Age_To' => 70,
        ]);
        $result['data16']=DEADS_TB::GET_DEADS_REGION($request->all());
        $result['data35']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());


        $request->merge([
            'Age_From' => 60,
            'Age_To' => 65,
        ]);
        $result['data17']=DEADS_TB::GET_DEADS_REGION($request->all());
        $result['data34']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());


        $request->merge([
            'Age_From' => 55,
            'Age_To' => 60,
        ]);
        $result['data18']=DEADS_TB::GET_DEADS_REGION($request->all());
        $result['data19']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());



        $request->merge([
            'Age_From' => 90,
            'Age_To' => 95,
        ]);
        $result['data20']=DEADS_TB::GET_DEADS_REGION($request->all());
        $result['data33']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());


        $request->merge([
            'Age_From' => 85,
            'Age_To' => 90,
        ]);
        $result['data21']=DEADS_TB::GET_DEADS_REGION($request->all());
        $result['data32']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());


        $request->merge([
            'Age_From' => 80,
            'Age_To' => 85,
        ]);
        $result['data22']=DEADS_TB::GET_DEADS_REGION($request->all());
        $result['data31']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());


        $request->merge([
            'Age_From' => 75,
            'Age_To' => 80,
        ]);
        $result['data23']=DEADS_TB::GET_DEADS_REGION($request->all());
        $result['data24']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());

        $request->merge([
            'Age_From' => 0,
            'Age_To' => 1500,
        ]);
        $result['data25']=DEADS_TB::GET_DEADS_REGION($request->all());
        $result['data30']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());


        $request->merge([
            'Age_From' => 95,
            'Age_To' => 1500,
        ]);
        $result['data26']=DEADS_TB::GET_DEADS_REGION($request->all());
        $result['data29']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());


        // $request->merge([
        //     'Age_From' => 95,
        //     'Age_To' => 300,
        // ]);
        // $result['data27']=DEADS_TB::GET_DEADS_REGION($request->all());
        // $result['data28']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());


       // dd($result['data7']);
        return view('Report.Distribution_Region_Ages',$result);

    }

//----------------------------------------------------------------------------
public function GET_Distribution_Death_Place_Kids(Request $request)
{
    // ini_set('max_execution_time', -1);
    // ini_set('memory_limit',-1);
    $query = DEADS_TB::GET_Distribution_Death_Place_Kids($request->all());
    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'DEADS_TB';
    $data1['column_name'] = ' ';
   // $data1['old_record'] = $request->all();
    $data1['type_action'] = 'DL';
    Log::create($data1);
//  dd(Auth());
    $result['data']=$query;
    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;
    // dd($result['old_record']);
    return view('Report.Distribution_Death_Place_Kids',$result);

}
//----------------------------------------------------------------------------
public function GET_Distribution_Region_Kids(Request $request)
{
    // ini_set('max_execution_time', -1);
    // ini_set('memory_limit',-1);
    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;
    $request->merge([
        'Age_From' => 0,
        'Age_To' => 365,
    ]);
    $result['data'] = DEADS_TB::GET_Distribution_Region_Kids($request->all());
    $result['data1'] = DEADS_TB::GET_DEADS_REGION_TOTAL_KIDS($request->all());


    $request->merge([
        'Age_From' => 28,
        'Age_To' => 365,
    ]);
    $result['data2'] = DEADS_TB::GET_Distribution_Region_Kids($request->all());
    $result['data3'] = DEADS_TB::GET_DEADS_REGION_TOTAL_KIDS($request->all());

    $request->merge([
        'Age_From' => 7,
        'Age_To' => 28,
    ]);
    $result['data4'] = DEADS_TB::GET_Distribution_Region_Kids($request->all());
    $result['data5'] = DEADS_TB::GET_DEADS_REGION_TOTAL_KIDS($request->all());

    $request->merge([
        'Age_From' => 0,
        'Age_To' => 7,
    ]);
    $result['data6'] = DEADS_TB::GET_Distribution_Region_Kids($request->all());
    $result['data7'] = DEADS_TB::GET_DEADS_REGION_TOTAL_KIDS($request->all());

 // dd($query);
    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'DEADS_TB';
    $data1['column_name'] = ' ';
   // $data1['old_record'] = $request->all();
    $data1['type_action'] = 'DL';
    Log::create($data1);
//  dd(Auth());


    // dd($result['old_record']);
    return view('Report.Distribution_Region_Kids',$result);

}
//----------------------------------------------------------------------------
public function GET_Distribution_Region_Ages1(Request $request)
{

    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;
    $request->merge([
        'Age_From' => 20,
        'Age_To' => 60,
    ]);
    $result['data'] = DEADS_TB::GET_Distribution_Region_Ages1($request->all());
    $result['data1']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());

    $request->merge([
        'Age_From' => 5,
        'Age_To' => 20,
    ]);
    $result['data2'] = DEADS_TB::GET_Distribution_Region_Ages1($request->all());
    $result['data3']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());

    $request->merge([
        'Age_From' => 1,
        'Age_To' => 5,
    ]);
    $result['data4'] = DEADS_TB::GET_Distribution_Region_Ages1($request->all());
    $result['data5']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());

    $request->merge([
        'Age_From' => 0,
        'Age_To' => 1,
    ]);
    $result['data6'] = DEADS_TB::GET_Distribution_Region_Ages1($request->all());
    $result['data7']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());

    $request->merge([
        'Age_From' => 0,
        'Age_To' => 1500,
    ]);
    $result['data8'] = DEADS_TB::GET_Distribution_Region_Ages1($request->all());
    $result['data9']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());

    $request->merge([
        'Age_From' => 60,
        'Age_To' => 1500,
    ]);
    $result['data10'] = DEADS_TB::GET_Distribution_Region_Ages1($request->all());
    $result['data11']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());

    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'DEADS_TB';
    $data1['column_name'] = ' ';
   // $data1['old_record'] = $request->all();
    $data1['type_action'] = 'DL';
    Log::create($data1);

    return view('Report.Distribution_Region_Ages1',$result);

}
//----------------------------------------------------------------------------
public function GET_Distribution_Region_Ages2(Request $request)
{

    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;

    $request->merge([
        'Age_From' => 20,
        'Age_To' => 60,
    ]);
    $result['data'] = DEADS_TB::GET_Distribution_Region_Ages2($request->all());
    $result['data1']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());

    $request->merge([
        'Age_From' => 5,
        'Age_To' => 20,
    ]);
    $result['data2'] = DEADS_TB::GET_Distribution_Region_Ages2($request->all());
    $result['data3']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());

    $request->merge([
        'Age_From' => 0,
        'Age_To' => 5,
    ]);
    $result['data4'] = DEADS_TB::GET_Distribution_Region_Ages2($request->all());
    $result['data5']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());

    $request->merge([
        'Age_From' => 0,
        'Age_To' => 1500,
    ]);
    $result['data6'] = DEADS_TB::GET_Distribution_Region_Ages2($request->all());
    $result['data7']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());


    $request->merge([
        'Age_From' => 60,
        'Age_To' => 1500,
    ]);
    $result['data8'] = DEADS_TB::GET_Distribution_Region_Ages2($request->all());
    $result['data9']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());

 // dd($query);
    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'DEADS_TB';
    $data1['column_name'] = ' ';
   // $data1['old_record'] = $request->all();
    $data1['type_action'] = 'DL';
    Log::create($data1);
//  dd(Auth());

    // dd($result['old_record']);
    return view('Report.Distribution_Region_Ages2',$result);

}
//----------------------------------------------------------------------------
public function GET_Distribution_Death_Hosp(Request $request)
{
    // ini_set('max_execution_time', -1);
    // ini_set('memory_limit',-1);
    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;
    $request->merge([
        'Age_From' => 0,
        'Age_To' => 1500,
    ]);
    $query = DEADS_TB::GET_Distribution_Death_Hosp($request->all());
 // dd($query);
    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'DEADS_TB';
    $data1['column_name'] = ' ';
   // $data1['old_record'] = $request->all();
    $data1['type_action'] = 'DL';
    Log::create($data1);
//  dd(Auth());
    $result['data']=$query;

    // dd($result['old_record']);
    return view('Report.Distribution_Death_Hosp',$result);

}
//----------------------------------------------------------------------------
public function GET_Distribution_Region_Ages3(Request $request)
{
    // ini_set('max_execution_time', -1);
    // ini_set('memory_limit',-1);
    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;
    $request->merge([
        'Age_From' => 0,
        'Age_To' => 18,
    ]);
    $result['data'] = DEADS_TB::GET_Distribution_Region_Ages3($request->all());
    $result['data1']=DEADS_TB::GET_DEADS_REGION_TOTAL($request->all());
 // dd($query);
    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'DEADS_TB';
    $data1['column_name'] = ' ';
   // $data1['old_record'] = $request->all();
    $data1['type_action'] = 'DL';
    Log::create($data1);
//  dd(Auth());


    // dd($result['old_record']);
    return view('Report.Distribution_Region_Ages3',$result);

}
//----------------------------------------------------------------------------
public function GET_Distribution_Death_Hos_Kids(Request $request)
{
    // ini_set('max_execution_time', -1);
    // ini_set('memory_limit',-1);
    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;
    $request->merge([
        'Age_From' => 0,
        'Age_To' => 1,
    ]);
    $result['data'] = DEADS_TB::GET_Distribution_Death_Hos_Kids($request->all());
 // dd($query);
    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'DEADS_TB';
    $data1['column_name'] = ' ';
   // $data1['old_record'] = $request->all();
    $data1['type_action'] = 'DL';
    Log::create($data1);
//  dd(Auth());


    // dd($result['old_record']);
    return view('Report.Distribution_Death_Hos_Kids',$result);

}
//----------------------------------------------------------------------------
public function GET_Distribution_sex_D(Request $request)
{
    // ini_set('max_execution_time', -1);
    // ini_set('memory_limit',-1);
    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;
    $request->merge([
        'Age_From' => 1,
        'Age_To' => 300,
    ]);
    $result['data'] = DEADS_TB::GET_Distribution_sex_D($request->all());
    $result['data1']=DEADS_TB::GET_DEADS_BY_SEX_TOTAL($request->all());

    $request->merge([
        'Age_From' => 0,
        'Age_To' => 1,
    ]);
    $result['data2'] = DEADS_TB::GET_Distribution_sex_D($request->all());
    $result['data3']=DEADS_TB::GET_DEADS_BY_SEX_TOTAL($request->all());

 // dd($query);
    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'DEADS_TB';
    $data1['column_name'] = ' ';
   // $data1['old_record'] = $request->all();
    $data1['type_action'] = 'DL';
    Log::create($data1);
//  dd(Auth());


    // dd($result['old_record']);
    return view('Report.Distribution_sex_D',$result);

}
//----------------------------------------------------------------------------
public function GET_Daily_Dead_Rep_2(Request $request)
{
    // ini_set('max_execution_time', -1);
    // ini_set('memory_limit',-1);
    $result['hospitals'] = DEADS_TB::ALL_HOS_DREF();
    $result['entry_reg_place'] = C_DETAILS_REFERRAL_TB::whereIn('DREF_M_CD', [2,3])->orwhereIn('DREF_CODE', [134,125,146])->get();
    $result['list_user'] = DEADS_TB::GET_USER_PROFILE();
    //dd($result['list_user']);

    // $query = DEADS_TB::GET_Daily_Dead_Rep_2($request->all());
 // dd($query);
    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'DEADS_TB';
    $data1['column_name'] = ' ';
   // $data1['old_record'] = $request->all();
    $data1['type_action'] = 'DL';
    Log::create($data1);
//  dd(Auth());
    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;
    // dd($result['old_record']);
    return view('Report.Daily_Dead_Rep_2',$result);

}
//----------------------------------------------------------------------------
public function Get_Daily_Dead_Result(Request $request)
{
    $role = [
        'Sex' => 'nullable|numeric',
        'Dead_ID' => 'nullable|numeric|digits:9',
        'Death_date_frm' => 'nullable|date_format:d/m/Y|before:' . date('d/m/Y'),
        'Death_date_to' => 'nullable|date_format:d/m/Y|before:' . date('d/m/Y'),
        'Age_From' => 'numeric|nullable',
        'Age_To' => 'numeric|nullable',
        'Diag_From' => 'numeric|nullable',
        'Diag_To' => 'numeric|nullable',
        'Year_From' => 'numeric|nullable',
        'Year_To' => 'numeric|nullable',
        'DEAD_DEATH_PLACE_CD' => 'numeric|nullable',
        'DEAD_HOS_NAME_CD' => 'numeric|nullable',
        'USER_FULL_NAME' => 'numeric|nullable',
        'BORN_DETAILS_HEALTH_CENTER_CD2' => 'numeric|nullable',

    ];

    $data = $request->validate($role);

    $query = DEADS_TB::GET_Daily_Dead_Rep_2($request->all());
    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'DEADS_TB';
    $data1['column_name'] = ' ';
    $data['old_record'] = $request->all();
    $data1['type_action'] = 'S';
    Log::create($data1);

    $count=$query['RESULT_COUNT'];
    $totalData =$count;
    $totalFiltered =$totalData;
    $result['data'] = [];
    if ($query['data']) {

        foreach ($query['data'] as $key => $value) {


            $result['data'][] = array(
                $key + 1,
                $value['DEAD_ID'],
                $value['DEAD_DOB'],
                 $value['DEAD_DOD'],
                $value['DEAD_SEX'],
                $value['DEAD_NAME'],
                $value['DEAD_HOS'],
                $value['DEAD_REG'],
                 $value['DIAG'],
                $value['D_ICD'],
                 $value['DIAG1'],
                $value['D_ICD1'],
                 $value['DEAD_IS_SCAN'],

            );
        }
    }
    $json_data = array(
        "draw"            => intval($request->draw),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data"            => $result['data']

         );
echo json_encode($json_data);

}

//----------------------------------------------------------------------------
public function Get_Daily_Dead_Rep_D(Request $request)
{
    $role = [
        'Sex' => 'nullable|numeric',
        'Dead_ID' => 'nullable|numeric|digits:9',
        'Death_date_frm' => 'nullable|date_format:d/m/Y|before:' . date('d/m/Y'),
        'Death_date_to' => 'nullable|date_format:d/m/Y|before:' . date('d/m/Y'),
        'Age_From' => 'numeric|nullable',
        'Age_To' => 'numeric|nullable',
        'Diag_From' => 'numeric|nullable',
        'Diag_To' => 'numeric|nullable',
        'Year_From' => 'numeric|nullable',
        'Year_To' => 'numeric|nullable',
        'DEAD_DEATH_PLACE_CD' => 'numeric|nullable',
        'DEAD_HOS_NAME_CD' => 'numeric|nullable',
        'USER_FULL_NAME' => 'numeric|nullable',
        'BORN_DETAILS_HEALTH_CENTER_CD2' => 'numeric|nullable',

    ];

    $data = $request->validate($role);

    $query = DEADS_TB::GET_Daily_Report_D($request->all());
    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'DEADS_TB';
    $data1['column_name'] = ' ';
    $data['old_record'] = $request->all();
    $data1['type_action'] = 'S';
    Log::create($data1);

    $count=$query['RESULT_COUNT'];
    $totalData =$count;
    $totalFiltered =$totalData;
    $result['data'] = [];
    if ($query['data']) {

        foreach ($query['data'] as $key => $value) {


            $result['data'][] = array(
                $key + 1,
                $value['DEAD_ID'],
                $value['DEAD_DOB'],
                 $value['DEAD_DOD'],
                $value['DEAD_SEX'],
                $value['DEAD_NAME'],
                $value['DEAD_HOS'],
                $value['DEAD_REG'],
                 $value['DIAG'],
                $value['D_ICD'],
                 $value['DEAD_IS_SCAN'],

            );
        }
    }
    $json_data = array(
        "draw"            => intval($request->draw),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data"            => $result['data']

         );
echo json_encode($json_data);

}

//----------------------------------------------------------------------------
public function GET_Daily_Report_D(Request $request)
{
    $result['hospitals'] = DEADS_TB::ALL_HOS_DREF();
    $result['entry_reg_place'] = C_DETAILS_REFERRAL_TB::whereIn('DREF_M_CD', [2,3])->orwhereIn('DREF_CODE', [134,125,146])->get();
    $result['list_user'] = DEADS_TB::GET_USER_PROFILE();

    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'DEADS_TB';
    $data1['column_name'] = ' ';
   // $data1['old_record'] = $request->all();
    $data1['type_action'] = 'DL';
    Log::create($data1);
//  dd(Auth());
    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;
    // dd($result['old_record']);
    return view('Report.Daily_Report_D',$result);

}
//----------------------------------------------------------------------------
public function GET_Distribution_Diagnosis(Request $request)
{
    // ini_set('max_execution_time', -1);
    // ini_set('memory_limit',-1);
    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;
    $result['data'] = DEADS_TB::GET_Distribution_Diagnosis($request->all());
  //dd($result['data']);
    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'DEADS_TB';
    $data1['column_name'] = 'P';
   // $data1['old_record'] = $request->all();
    $data1['type_action'] = 'P';
    Log::create($data1);
//  dd(Auth());


    // dd($result['old_record']);
    return view('Report.Distribution_Diagnosis',$result);

}
//----------------------------------------------------------------------------
public function GET_Deads_non_Diagnosable(Request $request)
{
    // ini_set('max_execution_time', -1);
    // ini_set('memory_limit',-1);
    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;

    // dd($result['old_record']);
    return view('Report.Deads_non_Diagnosable',$result);

}

//----------------------------------------------------------------------------
public function GET_Deads_non_Diagnosable_all(Request $request)
{
    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;

 $query= DEADS_TB::GET_DEATHS_DIAGNOSED_LIMIT($request->all());

 $count = $query['RESULT_COUNT'];
 $totalData =$count;
 $totalFiltered =$totalData;
 $result['data'] = [];
 if ($query['data']) {

     foreach ($query['data'] as $key => $value) {
        $action = '<button type="button" class="btn btn-icon btn-bg-light btn-active-color-warning btn-sm me-3"
        onclick="update_crt_dead(' . $value['DEAD_ID'] . ');"  title="تعديل بيانات اشعار الوفاة">
         <i class="fa-solid fa-pen-to-square fs-3"></i>
    </button>';
         $result['data'][] = array(
             $action,
             $value['DEAD_NAME'],
             $value['DEAD_DOD'],
             $value['DEAD_DOB'],
             $value['DEAD_ID'],
             $key + 1,

         );
     }
 }
 $json_data = array(
     "draw"            => intval($request->draw),
     "recordsTotal"    => intval($totalData),
     "recordsFiltered" => intval($totalFiltered),
     "data"            => $result['data']

      );
 echo json_encode($json_data);
}
//----------------------------------------------------------------------------
public function GET_Total_In_Diagnosis(Request $request)
{
    // ini_set('max_execution_time', -1);
    // ini_set('memory_limit',-1);
    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;

    $result['data'] = DEADS_TB::GET_Total_In_Diagnosis($request->all());
 // dd($query);
    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'DEADS_TB';
    $data1['column_name'] = ' ';
   // $data1['old_record'] = $request->all();
    $data1['type_action'] = 'DL';
    Log::create($data1);
//  dd(Auth());

    // dd($result['old_record']);
    return view('Report.Total_In_Diagnosis',$result);

}
//----------------------------------------------------------------------------
public function GET_Unknown_Region_Deaths(Request $request)
{
    // ini_set('max_execution_time', -1);
    // ini_set('memory_limit',-1);
    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;

    return view('Report.Unknown_Region_Deaths',$result);

}

//----------------------------------------------------------------------------
public function GET_Unknown_Region_Deaths_ALL(Request $request)
{

    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;

 $query= DEADS_TB::GET_DEATHS_UNKNOWN_REG_LIMIT($request->all());

 $count = $query['RESULT_COUNT'];
 $totalData =$count;
 $totalFiltered =$totalData;
 $result['data'] = [];
 if ($query['data']) {
    $action = '';

     foreach ($query['data'] as $key => $value) {
        $action = '<button type="button" class="btn btn-icon btn-bg-light btn-active-color-warning btn-sm me-3"
        onclick="update_crt_dead(' . $value['DEAD_ID'] . ');"  title="تعديل بيانات اشعار الوفاة">
         <i class="fa-solid fa-pen-to-square fs-3"></i>
    </button>';
         $result['data'][] = array(
             $action,
             $value['DEAD_NAME'],
             $value['DEAD_DOD'],
             $value['DEAD_DOB'],
             $value['DEAD_ID'],
             $key + 1,

         );
     }
 }
 $json_data = array(
     "draw"            => intval($request->draw),
     "recordsTotal"    => intval($totalData),
     "recordsFiltered" => intval($totalFiltered),
     "data"            => $result['data']

      );
 echo json_encode($json_data);

}


//----------------------------------------------------------------------------
public function GET_Distribution_ICD_Ages(Request $request)
{
    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;
    if (!$request->has('ICD_OPTN')){
        $request->merge([
            'ICD_OPTN' => 1,
        ]);
    }
    else{
        $request->merge([
            'ICD_OPTN' => $request->ICD_OPTN,
        ]);
    }

    $request->merge([
        'Age_From' => 0,
        'Age_To' => 1,
    ]);
   // dd($request->all());
    $result['data'] = DEADS_TB::GET_Distribution_ICD_Ages($request->all());
    //dd($result['data']);
    $result['data1'] = DEADS_TB::GET_Distribution_ICD_Ages_Total($request->all());


    $request->merge([
        'Age_From' => 1,
        'Age_To' => 5,
    ]);
    $result['data2'] = DEADS_TB::GET_Distribution_ICD_Ages($request->all());
    $result['data3'] = DEADS_TB::GET_Distribution_ICD_Ages_Total($request->all());

    $request->merge([
        'Age_From' => 5,
        'Age_To' => 10,
    ]);
    $result['data4'] = DEADS_TB::GET_Distribution_ICD_Ages($request->all());
    $result['data5'] = DEADS_TB::GET_Distribution_ICD_Ages_Total($request->all());

    $request->merge([
        'Age_From' => 10,
        'Age_To' => 15,
    ]);
    $result['data6'] = DEADS_TB::GET_Distribution_ICD_Ages($request->all());
    $result['data7'] = DEADS_TB::GET_Distribution_ICD_Ages_Total($request->all());

    $request->merge([
        'Age_From' => 15,
        'Age_To' => 20,
    ]);
    $result['data8'] = DEADS_TB::GET_Distribution_ICD_Ages($request->all());
    $result['data9'] = DEADS_TB::GET_Distribution_ICD_Ages_Total($request->all());

    $request->merge([
        'Age_From' => 20,
        'Age_To' => 25,
    ]);
    $result['data10'] = DEADS_TB::GET_Distribution_ICD_Ages($request->all());
    $result['data11'] = DEADS_TB::GET_Distribution_ICD_Ages_Total($request->all());

    $request->merge([
        'Age_From' => 25,
        'Age_To' => 30,
    ]);
    $result['data12'] = DEADS_TB::GET_Distribution_ICD_Ages($request->all());
    $result['data13'] = DEADS_TB::GET_Distribution_ICD_Ages_Total($request->all());

    $request->merge([
        'Age_From' => 30,
        'Age_To' => 35,
    ]);
    $result['data14'] = DEADS_TB::GET_Distribution_ICD_Ages($request->all());
    $result['data15'] = DEADS_TB::GET_Distribution_ICD_Ages_Total($request->all());

    $request->merge([
        'Age_From' => 35,
        'Age_To' => 40,
    ]);
    $result['data16'] = DEADS_TB::GET_Distribution_ICD_Ages($request->all());
    $result['data17'] = DEADS_TB::GET_Distribution_ICD_Ages_Total($request->all());

    $request->merge([
        'Age_From' => 40,
        'Age_To' => 45,
    ]);
    $result['data18'] = DEADS_TB::GET_Distribution_ICD_Ages($request->all());
    $result['data19'] = DEADS_TB::GET_Distribution_ICD_Ages_Total($request->all());

    $request->merge([
        'Age_From' => 45,
        'Age_To' => 50,
    ]);
    $result['data20'] = DEADS_TB::GET_Distribution_ICD_Ages($request->all());
    $result['data21'] = DEADS_TB::GET_Distribution_ICD_Ages_Total($request->all());

    $request->merge([
        'Age_From' => 50,
        'Age_To' => 55,
    ]);
    $result['data22'] = DEADS_TB::GET_Distribution_ICD_Ages($request->all());
    $result['data23'] = DEADS_TB::GET_Distribution_ICD_Ages_Total($request->all());

    $request->merge([
        'Age_From' => 55,
        'Age_To' => 60,
    ]);
    $result['data24'] = DEADS_TB::GET_Distribution_ICD_Ages($request->all());
    $result['data25'] = DEADS_TB::GET_Distribution_ICD_Ages_Total($request->all());


    $request->merge([
        'Age_From' => 60,
        'Age_To' => 65,
    ]);
    $result['data26'] = DEADS_TB::GET_Distribution_ICD_Ages($request->all());
    $result['data27'] = DEADS_TB::GET_Distribution_ICD_Ages_Total($request->all());



    $request->merge([
        'Age_From' => 65,
        'Age_To' => 70,
    ]);
    $result['data28'] = DEADS_TB::GET_Distribution_ICD_Ages($request->all());
    $result['data29'] = DEADS_TB::GET_Distribution_ICD_Ages_Total($request->all());



    $request->merge([
        'Age_From' => 70,
        'Age_To' => 75,
    ]);
    $result['data30'] = DEADS_TB::GET_Distribution_ICD_Ages($request->all());
    $result['data31'] = DEADS_TB::GET_Distribution_ICD_Ages_Total($request->all());



    $request->merge([
        'Age_From' => 75,
        'Age_To' => 80,
    ]);
    $result['data32'] = DEADS_TB::GET_Distribution_ICD_Ages($request->all());
    $result['data33'] = DEADS_TB::GET_Distribution_ICD_Ages_Total($request->all());



    $request->merge([
        'Age_From' => 80,
        'Age_To' => 85,
    ]);
    $result['data34'] = DEADS_TB::GET_Distribution_ICD_Ages($request->all());
    $result['data35'] = DEADS_TB::GET_Distribution_ICD_Ages_Total($request->all());



    $request->merge([
        'Age_From' => 85,
        'Age_To' => 90,
    ]);
    $result['data36'] = DEADS_TB::GET_Distribution_ICD_Ages($request->all());
    $result['data37'] = DEADS_TB::GET_Distribution_ICD_Ages_Total($request->all());



    $request->merge([
        'Age_From' => 90,
        'Age_To' => 95,
    ]);
    $result['data38'] = DEADS_TB::GET_Distribution_ICD_Ages($request->all());
    $result['data39'] = DEADS_TB::GET_Distribution_ICD_Ages_Total($request->all());


    $request->merge([
        'Age_From' => 95,
        'Age_To' => 1500,
    ]);
    $result['data40'] = DEADS_TB::GET_Distribution_ICD_Ages($request->all());
    $result['data41'] = DEADS_TB::GET_Distribution_ICD_Ages_Total($request->all());

    $request->merge([
        'Age_From' => 0,
        'Age_To' => 1500,
    ]);
    $result['data42'] = DEADS_TB::GET_Distribution_ICD_Ages($request->all());
    $result['data43'] = DEADS_TB::GET_Distribution_ICD_Ages_Total($request->all());

    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'DEADS_TB';
    $data1['column_name'] = ' ';
   // $data1['old_record'] = $request->all();
    $data1['type_action'] = 'DL';
    Log::create($data1);

    return view('Report.Distribution_ICD_Ages',$result);

}
//----------------------------------------------------------------------------
public function GET_Distribution_MS_D(Request $request)
{
    // ini_set('max_execution_time', -1);
    // ini_set('memory_limit',-1);
    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;

    $result['data'] = DEADS_TB::GET_Distribution_MS_D($request->all());
    $result['data1'] = DEADS_TB::GET_DEADS_BY_MS_TOTAL($request->all());


 // dd($query);
    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'DEADS_TB';
    $data1['column_name'] = ' ';
   // $data1['old_record'] = $request->all();
    $data1['type_action'] = 'DL';
    Log::create($data1);
//  dd(Auth());


    // dd($result['old_record']);
    return view('Report.Distribution_MS_D',$result);

}
//----------------------------------------------------------------------------
public function GET_Distribution_ICD_Ages_sample2(Request $request)
{
    // ini_set('max_execution_time', -1);
    // ini_set('memory_limit',-1);
    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;
    $result['data'] = DEADS_TB::GET_ICD_CODE($request->all());

   // $result['data2'] = DEADS_TB::GET_DEADS_REGION_TOTAL2($request->all());

 // dd($query);
    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'DEADS_TB';
    $data1['column_name'] = ' ';
   // $data1['old_record'] = $request->all();
    $data1['type_action'] = 'DL';
    Log::create($data1);
//  dd(Auth());


    // dd($result['old_record']);
    return view('Report.Distribution_ICD_Ages_sample2',$result);

}
//----------------------------------------------------------------------------
public function GET_Scanned_files_rep(Request $request)
{
    $result['entry_reg_place'] = C_DETAILS_REFERRAL_TB::whereIn('DREF_M_CD', [2,3])->orwhereIn('DREF_CODE', [134,125,146])->get();

    $result['list_user'] = DEADS_TB::GET_USER_PROFILE();
    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;

 // dd($query);
    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'DEADS_TB';
    $data1['column_name'] = ' ';
   // $data1['old_record'] = $request->all();
    $data1['type_action'] = 'DL';
    Log::create($data1);

    return view('Report.Scanned_files_rep',$result);

}
//----------------------------------------------------------------------------
public function get_scanned_file_rep(Request $request)
{
    // ini_set('max_execution_time', -1);
    // ini_set('memory_limit',-1);
    $result['entry_reg_place'] = C_DETAILS_REFERRAL_TB::whereIn('DREF_M_CD', [2,3])->orwhereIn('DREF_CODE', [134,125,146])->get();

    $result['list_user'] = DEADS_TB::GET_USER_PROFILE();

    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;
    $query = DEADS_TB::GET_Scanned_files_rep($request->all());

    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'DEADS_TB';
    $data1['column_name'] = ' ';
    $data['old_record'] = $request->all();
    $data1['type_action'] = 'S';
    Log::create($data1);

    $count=$query['RESULT_COUNT'];
    $totalData =$count;
    $totalFiltered =$totalData;
    $result['data'] = [];
    if ($query['data']) {

        foreach ($query['data'] as $key => $value) {


            $result['data'][] = array(
                $key + 1,
                $value['DEAD_ID'],
                $value['DEAD_DOB'],
                 $value['DEAD_DOD'],
                $value['DEAD_SEX'],
                $value['DEAD_NAME'],
                $value['DEAD_HOS'],
                $value['DEAD_REG'],
            );
        }
    }
    $json_data = array(
        "draw"            => intval($request->draw),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data"            => $result['data']

         );
echo json_encode($json_data);

}

//----------------------------------------------------------------------------
public function GET_Death_updated_rep(Request $request)
{

    $result['entry_reg_place'] = C_DETAILS_REFERRAL_TB::whereIn('DREF_M_CD', [2,3])->orwhereIn('DREF_CODE', [134,125,146])->get();

    $result['list_user'] = DEADS_TB::GET_USER_PROFILE();

    //$query = DEADS_TB::GET_Death_updated_rep($request->all());
 // dd($query);
    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'DEADS_TB';
    $data1['column_name'] = ' ';
   // $data1['old_record'] = $request->all();
    $data1['type_action'] = 'DL';
    Log::create($data1);
//  dd(Auth());
    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;
    // dd($result['old_record']);
    return view('Report.Death_updated_rep',$result);

}
//----------------------------------------------------------------------------
public function get_updated_file_rep(Request $request)
{
    // ini_set('max_execution_time', -1);
    // ini_set('memory_limit',-1);
    $result['entry_reg_place'] = C_DETAILS_REFERRAL_TB::whereIn('DREF_M_CD', [2,3])->orwhereIn('DREF_CODE', [134,125,146])->get();

    $result['list_user'] = DEADS_TB::GET_USER_PROFILE();

    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;
    $query = DEADS_TB::GET_Death_updated_rep($request->all());

    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'DEADS_TB';
    $data1['column_name'] = ' ';
    $data['old_record'] = $request->all();
    $data1['type_action'] = 'S';
    Log::create($data1);

    $count=$query['RESULT_COUNT'];
    $totalData =$count;
    $totalFiltered =$totalData;
    $result['data'] = [];
    if ($query['data']) {

        foreach ($query['data'] as $key => $value) {


            $result['data'][] = array(
                $key + 1,
                $value['DEAD_ID'],
                $value['DEAD_DOB'],
                 $value['DEAD_DOD'],
                $value['DEAD_SEX'],
                $value['DEAD_NAME'],
                $value['DEAD_HOS'],
                $value['DEAD_REG'],
                $value['USER_NAME'],
                $value['DEAD_IS_SCAN'],


            );
        }
    }
    $json_data = array(
        "draw"            => intval($request->draw),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data"            => $result['data']

         );
echo json_encode($json_data);

}
//----------------------------------------------------------------------------
public function GET_NotScanned_files_rep(Request $request)
{
    $result['entry_reg_place'] = C_DETAILS_REFERRAL_TB::whereIn('DREF_M_CD', [2,3])->orwhereIn('DREF_CODE', [134,125,146])->get();

    $result['list_user'] = DEADS_TB::GET_USER_PROFILE();

    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'DEADS_TB';
    $data1['column_name'] = ' ';
   // $data1['old_record'] = $request->all();
    $data1['type_action'] = 'DL';
    Log::create($data1);
//  dd(Auth());
    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;
    // dd($result['old_record']);
    return view('Report.NotScanned_files_rep',$result);

}
//----------------------------------------------------------------------------
public function get_unscanned_file_rep(Request $request)
{
    $result['entry_reg_place'] = C_DETAILS_REFERRAL_TB::whereIn('DREF_M_CD', [2,3])->orwhereIn('DREF_CODE', [134,125,146])->get();

    $result['list_user'] = DEADS_TB::GET_USER_PROFILE();

    $result['old_record'] = $request->all();
    $result['user_name'] = Auth()->user()->name;
    $query = DEADS_TB::GET_NotScanned_files_rep($request->all());

    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'DEADS_TB';
    $data1['column_name'] = ' ';
    $data['old_record'] = $request->all();
    $data1['type_action'] = 'S';
    Log::create($data1);

    $count=$query['RESULT_COUNT'];
    $totalData =$count;
    $totalFiltered =$totalData;
    $result['data'] = [];
    if ($query['data']) {

        foreach ($query['data'] as $key => $value) {


            $result['data'][] = array(
                $key + 1,
                $value['DEAD_ID'],
                $value['DEAD_DOB'],
                 $value['DEAD_DOD'],
                $value['DEAD_SEX'],
                $value['DEAD_NAME'],
                $value['DEAD_HOS'],
                $value['DEAD_REG'],
            );
        }
    }
    $json_data = array(
        "draw"            => intval($request->draw),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data"            => $result['data']

         );
echo json_encode($json_data);

}

//----------------------------------------------------------------------------
public function Daily_Born(Request $request)
{
    $result['old_record'] = $request->all();
    $user_name=Auth()->user()->user_name;
    $result['user_name'] = Auth()->user()->name;
    $result['ROW'] = BORNS_INFO_TB::GET_USER_PROFILE($user_name);
$request->merge([
    'U_CODE' => $result['ROW'][0]['USER_DREF_CD'] ,
    'S' => 0,
    'E' => 42,
]);

//     $result['list_born'] = BORNS_INFO_TB::GET_BORNS($request->all());
//     $result['entry_borns'] = BORNS_INFO_TB::GET_BORNS_LIMIT($request->all());
//     //dd($result['entry_borns']);


//  // dd($query);
//     $data1['user_id'] = Auth()->id();
//     $data1['ip'] = request()->ip();
//     $data1['id_no'] = Auth()->id();
//     $data1['table_name'] = 'BORN_INFO_TB';
//     $data1['column_name'] = ' ';
//    // $data1['old_record'] = $request->all();
//     $data1['type_action'] = 'DL';
//     Log::create($data1);
// //  dd(Auth());

    // dd($result['old_record']);
    return view('Report.Daily_Born',$result);

}
public function get_Daily_Born(Request $request)
{
    $user_name=Auth()->user()->user_name;
    $result['user_name'] = Auth()->user()->name;
    $result['ROW'] = BORNS_INFO_TB::GET_USER_PROFILE($user_name);
    $result['old_record'] = $request->all();

$request->merge([
    'U_CODE' => $result['ROW'][0]['USER_DREF_CD'] ,

]);

$query = BORNS_INFO_TB::GET_BORNS_ALL($request->all());

    $count = $query['RESULT_COUNT'];
    $totalData =$count;
    $totalFiltered =$totalData;
    $result['data'] = [];
    if ($query['data']) {

        foreach ($query['data'] as $key => $value) {

            $result['data'][] = array(

                $value['DREF_NAME_AR'],
                $value['MOTHER_FULL_NAME'],
                $value['MOTHER_ID'],
                $value['FATHER_FULL_NAME'],
                $value['FATHER_ID'],
                $value['BI_FIRST_NAME'],
                $value['DELIVERY_DATE'],
                $value['BI_ID'],
                $key + 1,

            );
        }
    }
    $json_data = array(
        "draw"            => intval($request->draw),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data"            => $result['data']

         );
echo json_encode($json_data);
}
//----------------------------------------------------------------------------
public function Daily_Report_Birth_Place(Request $request)
{
    $user_name=Auth()->user()->user_name;
    $result['user_name'] = Auth()->user()->name;
    $result['ROW'] = BORNS_INFO_TB::GET_USER_PROFILE($user_name);
    $result['old_record'] = $request->all();

$request->merge([
    'U_CODE' => $result['ROW'][0]['USER_DREF_CD'] ,

]);

    $result['list_born'] = BORNS_INFO_TB::GET_PLACE_BORNS($request->all());

 // dd($query);
    $data1['user_id'] = Auth()->id();
    $data1['ip'] = request()->ip();
    $data1['id_no'] = Auth()->id();
    $data1['table_name'] = 'BORN_INFO_TB';
    $data1['column_name'] = ' ';
   // $data1['old_record'] = $request->all();
    $data1['type_action'] = 'DL';
    Log::create($data1);
//  dd(Auth());

    return view('Report.Daily_Report_Birth_Place',$result);

}
//----------------------------------------------------------------------------
public function Daily_Born_Delivery(Request $request)
{
    $user_name=Auth()->user()->user_name;
    $result['user_name'] = Auth()->user()->name;
    $result['ROW'] = BORNS_INFO_TB::GET_USER_PROFILE($user_name);
    $result['old_record'] = $request->all();

$request->merge([
    'U_CODE' => $result['ROW'][0]['USER_DREF_CD'] ,

]);

    return view('Report.Daily_Born_Delivery',$result);

}
//----------------------------------------------------------------------------
public function Daily_Born_Delivery_Print(Request $request)
{
    $user_name=Auth()->user()->user_name;
    $result['user_name'] = Auth()->user()->name;
    $result['ROW'] = BORNS_INFO_TB::GET_USER_PROFILE($user_name);
    $result['old_record'] = $request->all();

$request->merge([
    'U_CODE' => $result['ROW'][0]['USER_DREF_CD'] ,

]);

$query = BORNS_INFO_TB::GET_BORNS_ALL_DELIVERY($request->all());

$count = $query['RESULT_COUNT'];
$totalData =$count;
$totalFiltered =$totalData;
$result['data'] = [];
if ($query['data']) {

    foreach ($query['data'] as $key => $value) {

        $result['data'][] = array(
            $value['DREF_NAME_AR'],
            $value['MOTHER_FULL_NAME'],
            $value['MOTHER_ID'],
            $value['FATHER_FULL_NAME'],
            $value['FATHER_ID'],
            $value['BI_FIRST_NAME'],
            $value['DELIVERY_DATE'],
            $value['BI_ID'],
            $key + 1,

        );
    }
}
$json_data = array(
    "draw"            => intval($request->draw),
    "recordsTotal"    => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data"            => $result['data']

     );
echo json_encode($json_data);

}




}
