<?php

namespace App\Http\Controllers\dead;

use App\Http\Controllers\Controller;
use App\Imports\deadImport;
use App\Models\Citizen;
use App\Models\CitizenData;
use App\Models\Constant;
use App\Models\Martyr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ImportExcelDeadController extends Controller
{
    public function index()
    {
        return view('dead.import.index');
    }
    public function upload_file(Request $request)
    {
        $role = [
            'file' => 'required|mimes:xlsx,xls|max:10240',
        ];
        $validator = Validator::make($request->all(), $role);
        if ($validator->fails())
        {
            return Response::json(array(
                'success' => false,
                'errors' => implode('-',$validator->errors()->all())

            )); // 400 being the HTTP code for an invalid request.
        }
        ini_set('max_execution_time', -1);
        ini_set('memory_limit', -1);
        $array = Excel::toArray(new deadImport, $request->file('file'));
        if(count($array[0]) <= 1){
            return Response::json(array('success' => false,'errors'=>'يجب أن يحتوي الكشف على هوية واحدة على الأقل.'));
        }
        if(count($array[0]) > 4001){
            return Response::json(array('success' => false,'errors'=>'يجب أن يحتوي الكشف على 1000 سجل فقط .'));
        }
        $data_err = [];
        $data = [];
        $count_suss = 0;
        foreach ($array[0] as $key => $value) {
            if ($key == 0) {
                continue;
            }
            $role = [
                'id_no' => 'required|numeric|digits:9|unique:citizens,id_no|unique:martyrs,id_no|exists:oracle.CITIZEN_DATA,id',
                'hospital_id' => 'required|exists:constants,id',
                'Date_martyrdom' => 'required|date_format:d/m/Y|after:07/10/2023|before:'.date('d/m/Y'),
                'cause_death_id' => 'required|exists:constants,id',
                'region_id' => 'required|exists:constants,id',
                'city_id' => 'required|exists:constants,id',
            ];
            $data['id_no'] = $value[0];
            $data['hospital_id'] = $value[1];
            try{
                if(is_int($value[2])){
                    $new_date = ($value[2] - 25569) * 86400;
                    $data['Date_martyrdom'] = gmdate("d/m/Y", $new_date);
                }else{
                    $data['Date_martyrdom'] = $value[2]; //date("d/m/Y", $value[2]);
                }
            }catch (\Exception $exception){
                $result['mess'] =  'خطأ في صيغة تاريخ الاستشهاد';
                $result['key'] = $key;
                $result['id_no'] = $data['id_no'];
                array_push($data_err,$result);
                continue;
            }
            $data['cause_death_id'] = $value[3];
            $data['region_id'] = $value[4];
            $data['city_id'] = $value[5];
            $validator = Validator::make($data, $role);
            if ($validator->fails())
            {
                $result['mess'] =  implode('-',$validator->errors()->all());
                $result['key'] = $key;
                $result['id_no'] = $data['id_no'];
                array_push($data_err,$result);
                continue;
            }
            if(!$this->check_constant(7,$data['hospital_id']))
            {
                $result['mess'] = 'قيمة ثابت المستشفى غير صحيح';
                $result['key'] = $key;
                $result['id_no'] = $data['id_no'];
                array_push($data_err,$result);
                continue;
            }
            if(!$this->check_constant(103,$data['cause_death_id']))
            {
                $result['mess'] = 'قيمة ثابت سبب الاستشهاد غير صحيح';
                $result['key'] = $key;
                $result['id_no'] = $data['id_no'];
                array_push($data_err,$result);
                continue;
            }
            if(!$this->check_constant(25,$data['region_id']))
            {
                $result['mess'] = 'قيمة ثابت المحافظة غير صحيح';
                $result['key'] = $key;
                $result['id_no'] = $data['id_no'];
                array_push($data_err,$result);
                continue;
            }
            if(!$this->check_constant(41,$data['city_id']))
            {
                $result['mess'] = 'قيمة ثابت المدينة غير صحيح';
                $result['key'] = $key;
                $result['id_no'] = $data['id_no'];
                array_push($data_err,$result);
                continue;
            }
            $data_res = CitizenData::where('id',$data['id_no'])->first();
            try{
                DB::beginTransaction();
                $citizen_data['insert_user_id'] = Auth()->id();
                $citizen_data['id_no'] = $data['id_no'];
                $citizen_data['FIRST_NAME'] = $data_res['fname'];
                $citizen_data['FASTHER_NAME'] = $data_res['sname'];
                $citizen_data['GRAND_FATHER_NAME'] = $data_res['tname'];
                $citizen_data['FAMILY_NAME'] = $data_res['lname'];
                $citizen_data['DOB'] = Carbon::parse($data_res['birth_date'])->format('m/d/Y');
                $citizen_data['gender'] = $data_res['sex_code'];
                $citizen_data['nationality_id'] = 20;
                if($data_res['status_code'] == 21){
                    $citizen_data['social_status_id'] = 3;
                }else{
                    $citizen_data['social_status_id'] = $this->get_constant_id_by_name($data_res['status']);
                }
                $citizen_data['religion_id'] = $this->get_constant_id_by_name($data_res['religion']);
                $citizen_data['region_id'] = $data['region_id'];
                $citizen_data['city_id'] = $data['city_id'];
                Citizen::create($citizen_data);
                $martyr_data['id_no'] = $data['id_no'];
                $martyr_data['hospital_id'] = $data['hospital_id'];
                $martyr_data['Date_martyrdom'] = $data['Date_martyrdom'];
                $martyr_data['insert_user_id'] = Auth()->id();
                $martyr_data['cause_death_id'] = $data['cause_death_id'];
                $martyr_data['name'] = $data_res['fname'].' '.$data_res['sname'].' '.$data_res['tname'].' '.$data_res['lname'];
                Martyr::create($martyr_data);
                DB::commit();
                $count_suss++;
            }catch (\Exception $exception){
                DB::rollBack();
                $result['mess'] = $exception.'يوجد خطأ في عملية الإدخال';
                $result['key'] = $key;
                $result['id_no'] = $data['id_no'];
                array_push($data_err,$result);
                continue;
            }
        }
        return Response::json(array('success' => true,'count' => $count_suss,'result' =>$data_err));
    }
    public function get_download()
    {
        if (Storage::disk('public')->exists('download/upload.xlsx')) {
            return response()->download(storage_path('app\download\upload.xlsx'));

        }
    }
    function check_constant($parent_id,$const_id)
    {
        if(Constant::where('parent_id',$parent_id)->where('id',$const_id)->exists()){
            return true;
        }
        return false;
    }
    function get_constant_id_by_name($const_name)
    {
        $constant = Constant::where('name',$const_name)->first();
        if($constant){
            return $constant->id;
        }else{
            return '';
        }

    }
}
