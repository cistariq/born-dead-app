<?php

namespace App\Http\Controllers\dead;

use App\Http\Controllers\Controller;
use App\Models\PrintLog;
use App\Models\Attachment;
use App\Models\Citizen;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Exports\RecipientExport;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;
//use Excel;
use App\Models\Constant;
use App\Models\Recipient;

class RecipientController extends Controller
{
    public function index()
    {
        return view('dead.recipient.index');
    }
    public function multirecipient()
    {

        $data['cities'] = Constant::where('parent_id', 41)->get();
        $data['martyr_notics'] = Attachment::has('martyrs')->get();
        return view('dead.recipient.multi_recipient', $data);
    }
    public function searchrecipient()
    {

        $data['cities'] = Constant::where('parent_id', 41)->get();
        $data['martyr_notics'] = Attachment::has('martyrs')->get();
        return view('dead.recipient.search_rec', $data);
    }
    public function getDataResult(Request $request)
    {
        $role = [
            'P_ID' => 'numeric|digits:9|required',
        ];
        $data = $request->validate($role);
        $data_res = PrintLog::has('citizen')->where('id_no', $data['P_ID'])->get();
        $result['data'] = [];
        if ($data_res) {
            foreach ($data_res as $key => $value) {
                if (!$value->recipient_id_no && IsPermissionBtn(4)) {
                    $action = '<button type="button" class="btn btn-dark" onclick="insertRecipient(' . $value->id . ')"
                    ">تسجيل مستلم</button>  ';
                } else {
                    $action = '';
                }

                $result['data'][] = array(
                    $key + 1,
                    $value->id_no,
                    $value->citizen->FIRST_NAME . ' ' . $value->citizen->FASTHER_NAME . ' ' . $value->citizen->GRAND_FATHER_NAME . ' ' . $value->citizen->FAMILY_NAME,
                    $value->martyr->Date_martyrdom,
                    $value->recipient_id_no,
                    $value->recipient_name,
                    $value->created_at->toDateTimeString(),
                    $action,
                );
            }
        }
        echo json_encode($result);
    }
    public function update(Request $request)
    {
        $role = [
            'rec_seq' => 'numeric|exists:print_logs,id|required',
            'recipient_id_no' => 'numeric|required|digits:9',
            'recipient_name' => 'string|required',
        ];

        $validator = Validator::make($request->all(), $role);
        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            )); // 400 being the HTTP code for an invalid request.
        }
        $print_log = PrintLog::findOrFail($request->rec_seq);
        if ($print_log) {
            $print_log->recipient_id_no = $request->recipient_id_no;
            $print_log->recipient_name = $request->recipient_name;
            $print_log->recipient_user_id = Auth()->id();
            $print_log->save();

            return Response::json(array('success' => true, 'results' => ['message' => 'تمت عملية إدخال البيانات بنجاح']));
        }
        return Response::json(array('success' => false, 'results' => ['message' => 'يوجد خطأ في عملية التسلم حاول مرة أخرى']));
    }

    public function getPersonalInfoByIdNo(Request $request)
    {
        $role = [
            'id_no' => 'numeric|digits:9|required',
        ];
        $validator = Validator::make($request->all(), $role);
        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            )); // 400 being the HTTP code for an invalid request.
        }
        $data = Citizen::has('Attachment')->where('id_no', $request->id_no)->first();
        //  dd($data);
        // dd($data->citizen->FIRST_NAME);
        if ($data) {
            //$data->recipient_name = $request->citizen->name;
            $martyr_name = $data->FIRST_NAME . ' ' . $data->FASTHER_NAME . ' ' . $data->GRAND_FATHER_NAME . ' ' . $data->FAMILY_NAME;
            return Response::json(array('success' => true, 'name' => $martyr_name));
        } else {
            return Response::json(array('success' => false, 'errors' => array('id' => ['رقم الهوية غير موجود'])));
        }
    }
    public function store(Request $request)
    {
        $role = [
            'P_id.*' => 'required|numeric|digits:9|distinct',
            'P_NAME.*' => 'required',
            'P_city_id' => 'required',
            'P_FULL_NAME' => 'required',
            'P_ID_NO' => 'required|numeric|digits:9',
            'P_MOBILE' => 'required|numeric|digits_between:9,10',

        ];
        $validator = Validator::make($request->all(), $role);
        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            )); // 400 being the HTTP code for an invalid request.
        }
        try {
            $edata['city_id'] = $request->P_city_id;
            $data['recipient_id_no'] = $request->P_ID_NO;
            $data['recipient_name'] = $request->P_FULL_NAME;
            $data['mobile'] = $request->P_MOBILE;
            $data['user_id'] =  Auth()->id();
            foreach ($request->P_id as $key => $value) {
                $data['id_no'] = $request->P_id[$key];
                $data['name'] = $request->P_NAME[$key];
                Recipient::create($data);
            }
        } catch (\Exception $exception) {
            return Response::json(array('success' => false, 'results' => ['message' => $exception . 'يوجد خطأ في عملية الإدخال']));
        }
        return Response::json(array('success' => true, 'results' => ['message' => 'تمت عملية الإدخال بنجاح']));
    }

    public function getRecipient_Info(Request $request)
    {
        $role = [
            'martyr_id' => 'numeric|digits:9|nullable',
            'recipient_id' => 'numeric|digits:9|nullable',
            'city_no' => 'numeric|nullable',

        ];
        $data = $request->validate($role);
        $query = Recipient::where('city_id', $data['city_no'])->get();
        $check = false;

        if ($data['recipient_id'] != null) {
            $query->where('recipient_id_no', $data['recipient_id']);
            $check = true;
        }
        if ($data['martyr_id'] != null) {
            $query->where('id_no', $data['martyr_id']);
            $check = true;
        }
        if ($check) {
            $data_res = $query->where('status', 1)->get();
        } else {
            $data_res = [];
        }
        $result['data'] = [];
        if ($data_res) {
            foreach ($data_res as $key => $value) {

                $result['data'][] = array(
                    $key + 1,
                    $value->id_no,
                    $value->name,
                    $value->constants->name,
                    $value->recipient_id_no,
                    $value->recipient_name,
                    $value->mobile,
                );
            }
        }
        echo json_encode($result);
    }

    public function export_excel()
    {
        // $role = [
        //     'martyr_id' => 'numeric|digits:9|nullable',
        //     'recipient_id' => 'numeric|digits:9|nullable',
        //     'city_no' => 'numeric|nullable',

        // ];
        // $data = $request->validate($role);
        // $query = Recipient::where('city_id', $data['city_no'])->get();
        // $check = false;

        // if ($data['recipient_id'] != null) {
        //     $query->where('recipient_id_no', $data['recipient_id']);
        //     $check = true;
        // }
        // if ($data['martyr_id'] != null) {
        //     $query->where('id_no', $data['martyr_id']);
        //     $check = true;
        // }
        // if ($check) {
        //     $data_res = $query->where('status', 1)->get();
        // } else {
        //     $data_res = [];
        // }
        // $result['data'] = [];
        // if ($data_res) {
        //     foreach ($data_res as $key => $value) {

        //         $result['data'][] = array(
        //             $key + 1,
        //             $value->id_no,
        //             $value->name,
        //             $value->constants->name,
        //             $value->recipient_id_no,
        //             $value->recipient_name,
        //             $value->mobile,
        //         );
        //     }
        // }
   
        return Excel::download(new RecipientExport, 'Recipient.csv');

    }
}
